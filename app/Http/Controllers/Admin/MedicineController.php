<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Helpers\Helper;
use App\Eloquent\Medicine;
use App\Eloquent\CategoryMedicineRelated;
use App\Eloquent\Image;
use App\Eloquent\Category;
use App\Http\Requests\MedicinePost;
use DB;

class MedicineController extends Controller
{
    
    protected $medicine;
    protected $relatedCateMedi;
    protected $image;
    protected $category;

    public function __construct(
        Medicine $medicine,
        CategoryMedicineRelated $relatedCateMedi,
        Image $image,
        Category $category
    ){
        $this->medicine = $medicine;
        $this->relatedCateMedi = $relatedCateMedi;
        $this->image = $image;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = $this->medicine->orderBy('id', 'desc')->paginate(10);
        $data['medicines'] = $medicines;
        $data['optionAlowedBuy'] = $this->medicine->getOptionAllowedBuy();

        return view('admin.medicine.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $allOptionCategories = $this->category->getAllOptionCategories();
        $optionAlowedBuy = $this->medicine->getOptionAllowedBuy();

    	return view('admin.medicine.add', compact(['allOptionCategories', 'optionAlowedBuy']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicinePost $request)
    {
        $medicine = $this->medicine->fill($request->except(['images']));
        $medicine->user_id = Auth::user()->id;

        DB::beginTransaction();
        try {
            $medicine->save();

            if (!$medicine->id) {
                return redirect()->route('medicine.index');
            }

            $images = [];
            if ($request->file('images')) $images = $request->file('images');
            foreach ($images as $image) {
                if ($image) {
                    $image->hashName();
                    $path = $image->store(Medicine::PATH_MEDICINE . $medicine->id, 'uploads');
                    Helper::saveImageMedicine($medicine->id, $path, '', 1);
                }
            }
                
            foreach ($request->categories as $category) {
                $relatedCateMedi = new CategoryMedicineRelated;
                $relatedCateMedi->medicine_id = $medicine->id;
                $relatedCateMedi->category_id = $category;
                $relatedCateMedi->save();
            }

            DB::commit();
            $message = __('Add new medicine :name successfully!', ['name' => $medicine->name]);
            Helper::addMessageFlashSession(__('Success'), $message, 'success');

            return redirect()->route('medicine.index');
        } catch (Exception $e) {
            DB::rollBack();
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');

            return redirect()->route('medicine.create')->withInput($request->input);
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicine = $this->medicine->find($id);
        if (!$medicine) {
            $message = __('Medicine not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');

            return redirect()->route('medicine.index');
        }
        
        $categories = $this->relatedCateMedi->where('medicine_id', $id)->get();
        $selectCategories = [];
        foreach ($categories as $category) {
            $selectCategories[] = $category->category_id;
        }

        $allOptionCategories = $this->category->getAllOptionCategories();
        $optionAlowedBuy = $this->medicine->getOptionAllowedBuy();

        $images = $this->image->where('medicine_id', $id)->get();
        $data['selectCategories'] = $selectCategories;
        $data['images'] = $images;
        $data['allOptionCategories'] = $allOptionCategories;
        $data['optionAlowedBuy'] = $optionAlowedBuy;

        return view('admin.medicine.edit', ['medicine' => $medicine, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicinePost $request, $id)
    {
        $medicine = $this->medicine->find($id);
        if (!$medicine) {
            $message = __('Medicine not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');

            return redirect()->route('medicine.index');
        }

        $medicine = $medicine->fill($request->except(['images']));

        try {
            $medicine->save();

            $imagesDelete = [];
            if ($request->image_delete) $imagesDelete = $request->image_delete;
            foreach ($imagesDelete as $image_id) {
                $image = Image::find($image_id);
                if ($image) {
                    Helper::deleteFile($image->path_origin);
                    Helper::deleteFile($image->path_thumb);
                    $image->delete();
                }
            }

            $images = [];
            if ($request->file('images')) $images = $request->file('images');
            foreach ($images as $image) {
                if ($image) {
                    $image->hashName();
                    $path = $image->store(Medicine::PATH_MEDICINE . $medicine->id, 'uploads');
                    Helper::saveImageMedicine($medicine->id, $path, '', 1);
                }
            }

            
            // Delete category not selected
            $allCategories = $this->relatedCateMedi->where('medicine_id', $id)->get();
            $selectCategories = $request->categories;
            foreach ($allCategories as $category) {
                if (!in_array($category->category_id, $selectCategories)){
                    $category->delete();
                }
            }

            // Add category selected
            foreach ($request->categories as $category_id) {
                $findOldCate = $this->relatedCateMedi->where('medicine_id', $id)->where('category_id', $category_id)->first();
                if (!$findOldCate){
                    $relatedCateMedi = new CategoryMedicineRelated;
                    $relatedCateMedi->medicine_id = $id;
                    $relatedCateMedi->category_id = $category_id;
                    $relatedCateMedi->save();
                }
            }

            $message = __('Edit medicine :name successfully!', ['name' => $medicine->name]);
            Helper::addMessageFlashSession(__('Success'), $message, 'success');

            return redirect()->route('medicine.index');
        } catch (Exception $e){
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');

            return redirect()->route('medicine.edit', $id)->withInput($request->input);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine = $this->medicine->find($id);
        if (!$medicine) {
            $message = __('Medicine not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');
            
            return redirect()->route('medicine.index');
        }

        $images = $this->image->where('medicine_id', $id)->get();
        foreach ($images as $image) {
            try {
                Helper::deleteFile($image->path_origin);
                Helper::deleteFile($image->path_thumb);
                $image->delete();
            } catch(Exception $e) {
                Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
            }
        }

        $relatedCateMedis = $this->relatedCateMedi->where('medicine_id', $id)->get();
        foreach ($relatedCateMedis as $relatedCateMedi) {
            try {
                $relatedCateMedi->delete();
            } catch(Exception $e) {
                Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
            }
        }

        try {
            $medicine->delete();
            $message = __('Delete medicine :name successfully!', ['name' => $medicine->name]);
            Helper::addMessageFlashSession(__('Success'), $message, 'success');
        } catch(Exception $e) {
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
        }

        return redirect()->route('medicine.index');
    }
}
