<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Category;
use Validator;
use App\Helpers\Helper;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = [];
        $categoryParents = $this->category->where('parent_id', null)->paginate(5);
        foreach ($categoryParents as $categoryParent) {
            $parent_id = $categoryParent->id;
            $categoryChildren = $this->category->where('parent_id', $parent_id)->get();
            $categoryParent->children = $categoryChildren;
            $categories[] = $categoryParent;
        }

        $data['categories'] = $categories;
        $data['categoryParents'] = $categoryParents; //Paginate

        return view('admin.category.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'link' => 'required|max:255',
            'image' => 'image',
        ]);

        $validator->after(function ($validator) {
            $dataRequest = $validator->getData();
            $dataRequest['link'] = str_slug($dataRequest['link']);
            $parent_id = null;
            if (isset($dataRequest['parent_id'])) $parent_id = $dataRequest['parent_id'];

            $category = $this->category->where('link', $dataRequest['link'])->where('parent_id', $parent_id)->first();
            if ($category) {
                $validator->errors()->add('link', __('Sorry, this link already exists!'));
            }
        });

        if ($validator->fails()) {
            if ($request->parent_id) $link = route('category.subCreate', ['id' => $request->parent_id]);
            else $link = route('category.create');

            return redirect($link)
                ->withErrors($validator)
                ->withInput($request->input);
        }

        $category = $this->category;
        $category->fill($request->except(['image']));
        $category->link = str_slug($category->link);
        if ($request->hasFile('image')) {
            $nameFile = $request->image->hashName();
            $path = $request->file('image')->store(Category::PATH_CATEGORIES, 'uploads');
            $category->image = $path;
        }

        try {
            $category->save();

            if ($category->parent_id)
                $message = __('Add new sub category successfully!');
            else 
                $message = __('Add new parent category successfully!');

            Helper::addMessageFlashSession(__('Success'), $message, 'success');
        } catch (Exception $e){
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');

            return redirect('admin/category/create')->withInput($request->input);
        }

        return redirect('admin/category');
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
        $category = $this->category->find($id);
        if (!$category){
            $message = __('Category not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');

            return redirect()->route('category.index');
        }
        $optionParentCategory = $this->category->getOptionParentCategories();

        return view('admin.category.edit', compact(['category', 'optionParentCategory']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = $this->category->find($id);
        if (!$category){
            $message = __('Category not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');

            return redirect()->route('category.index');
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'link' => 'required|max:255',
            'image' => 'image',
        ]);
        $validator->id = $id;

        $validator->after(function ($validator) {
            $dataRequest = $validator->getData();
            $dataRequest['link'] = str_slug($dataRequest['link']);
            $parent_id = null;
            if (isset($dataRequest['parent_id'])) $parent_id = $dataRequest['parent_id'];

            $category = $this->category->where('link', $dataRequest['link'])->where('parent_id', $parent_id)->where('id', '<>', $validator->id)->first();
            if ($category) {
                $validator->errors()->add('link', __('Sorry, this link already exists!'));
            }
        });

        if ($validator->fails()) {
            return redirect()
                ->route('category.edit', [$category->id])
                ->withErrors($validator);
        }
        
        $category->fill($request->except(['images']));
        $category->link = str_slug($category->link);

        if ($request->hasFile('image')) {
            Helper::deleteFile($category->image);
            $nameFile = $request->image->hashName();
            $path = $request->file('image')->store(Category::PATH_CATEGORIES, 'uploads');
            $category->image = $path;
        }

        try {
            $category->save();
            $message = __('Edit category successfully!');
            Helper::addMessageFlashSession(__('Success'), $message, 'success');
        } catch (Exception $e){
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');

            return redirect()
                ->route('category.edit',[$category->id]);
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->find($id);

        if (!$category){
            $message = __('Category not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');

            return redirect()->route('category.index');
        }

        try {
            if ($category->parent_id == null){
                $children = $this->category->where('parent_id', $category->id)->get();
                foreach ($children as $subCategory) {
                    $subCategory->delete();
                    $message = __('Delete sub category :name successfully!', ['name' => $subCategory->name]);
                    Helper::addMessageFlashSession(__('Success'), $message, 'success');
                }
            }
        
            Helper::deleteFile($category->image);
            $category->delete();
            if ($category->parent_id == null){
                $message = __('Delete category :name successfully!', ['name' => $category->name]);
            } else {
                $message = __('Delete sub category :name successfully!', ['name' => $category->name]);
            }
            Helper::addMessageFlashSession(__('Success'), $message, 'success');

        } catch (Exception $e) {
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
        }

        return redirect()->route('category.index');
    }

    public function subCreate($id)
    {
        $parentCategory = $this->category->find($id);
        if (!$parentCategory){
            $message = __('Category not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');

            return redirect()->route('category.index');
        }
        $optionParentCategory = $this->category->getOptionParentCategories();

        return view('admin.category.addSub', compact(['parentCategory', 'optionParentCategory']));
    }
}
