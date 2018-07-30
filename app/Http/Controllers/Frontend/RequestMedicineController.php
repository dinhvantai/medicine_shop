<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\RequestMedicine;
use App\Eloquent\User;
use App\Eloquent\Image;
use App\Helpers\Helper;
use Validator;
use Response;
use Auth;
use DB;

class RequestMedicineController extends Controller
{
    
    protected $requestMedicine;
    protected $user;

    public function __construct(
        RequestMedicine $requestMedicine,
        User $user
    ){
        $this->requestMedicine = $requestMedicine;
        $this->user = $user;
    }

    public function requestIndex()
    {
        $requestMedicines = $this->requestMedicine->with('getAllImages')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(config('model.request_medicine.items_limit'));
        $optionStatus = $this->requestMedicine->getOptionStatus();

        return view('frontend.request-medicine.list', compact(['requestMedicines', 'optionStatus']));
    }

    public function jsonDetail(Request $request)
    {
        $requestMedicine = $this->requestMedicine->with('getAllImages')
            ->find($request->request_id);

        return Response::json($requestMedicine);
    }

    public function requestAddnew()
    {
        return view('frontend.request-medicine.addnew');
    }

    public function requestStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medicine_name' => 'required|max:255',
            'short_describer' => 'required',
            'images.*'    => 'image',
        ]);

        if ($validator->fails()) {
            return redirect()->route('frontend.request-medicine.addnew')
                ->withErrors($validator)->withInput($request->input);
        }

        $requestMedicine = $this->requestMedicine;
        $requestMedicine->fill($request->all());
        $requestMedicine->user_id = Auth::user()->id;

        DB::beginTransaction();
        try {
            $requestMedicine->save();

            if (!$requestMedicine->id) {
                return redirect()->route('frontend.request-medicine.index');
            }

            $images = is_array($request->file('images')) ? $request->file('images') : [];

            foreach ($images as $image) {
                if (!$image) {
                    continue;
                }
               
                $image->hashName();
                $path = $image->store(RequestMedicine::PATH_REQUEST . $requestMedicine->id, 'uploads');

                $imageModel = new Image;
                $imageModel->request_medicines_id = $requestMedicine->id;
                $imageModel->path_origin = $path;
                $imageModel->is_main = 1;
                $imageModel->save();
            }
           
            DB::commit();
            Helper::addMessageFlashFrontendSession(
                __('Success'),
                __('Add new request Medicine :name successfully!', ['name' => $requestMedicine->medicine_name]),
                'success'
            );

            return redirect()->route('frontend.request-medicine.index');
        } catch (Exception $e) {
            DB::rollBack();
            Helper::addMessageFlashFrontendSession(__('Error'), $e->getMessage(), 'danger');

            return redirect()->route('frontend.request-medicine.addnew')->withInput($request->input);
        }  
    }
}
