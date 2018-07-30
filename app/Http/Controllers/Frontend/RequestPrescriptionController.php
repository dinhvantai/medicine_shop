<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\RequestPrescription;
use App\Eloquent\User;
use App\Eloquent\Image;
use App\Eloquent\RelatedDoctorRequest;
use App\Helpers\Helper;
use Validator;
use Response;
use Auth;
use DB;

class RequestPrescriptionController extends Controller
{
    protected $requestPresctiption;
    protected $user;

    public function __construct(
        RequestPrescription $requestPresctiption,
        User $user
    ){
        $this->requestPresctiption = $requestPresctiption;
        $this->user = $user;
    }

    public function requestIndex()
    {
        $requestPrescriptions = $this->requestPresctiption->with('getAllImages', 'getAllPrescription')
            ->getRequestByUser(Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(config('model.request_prescription.items_limit'));

        return view('frontend.request-prescription.list', compact(['requestPrescriptions']));
    }

    public function requestAddnew()
    {
        $doctorOption = $this->user->getAllDoctorOption();

        return view('frontend.request-prescription.addnew', compact(['doctorOption']));
    }

    public function jsonDetail(Request $request)
    {
        $requestPresctiption = $this->requestPresctiption->with('getAllImages', 'getAllPrescription')
            ->find($request->request_id);

        return Response::json($requestPresctiption);
    }

    public function jsonDoctorDetail(Request $request)
    {

        $requestPresctiption = $this->requestPresctiption
            ->with('getAllImages', 'getAllPrescription', 'getUser')
            ->find($request->request_id);

        $related = RelatedDoctorRequest::where('doctor_id', Auth::user()->id)
            ->where('request_prescription_id', $request->request_id)->first();

        if ($related && $related->status == RelatedDoctorRequest::STATUS_NEW){
            $related->status = RelatedDoctorRequest::STATUS_WATCHECD;
            $related->save();
        }

        $requestPresctiption->getUser->genderLabel = __('Not selected');
        $optionGender = $this->user->getGenderOption();
        if (isset($optionGender[$requestPresctiption->getUser->gender])) {
            $requestPresctiption->getUser->genderLabel = $optionGender[$requestPresctiption->getUser->gender];
        }
        
        $data['data'] = $requestPresctiption;
        $data['countRequest'] = Helper::countNewRequestPrescriptionDoctor();

        return Response::json($data);
    }

    public function requestStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'describer' => 'required',
            'doctors' => 'required',
            'images.*'    => 'image',
        ]);

        if ($validator->fails()) {
            return redirect()->route('request-prescription.addnew')
                ->withErrors($validator)->withInput($request->input);
        }

        $requestPresctiption = $this->requestPresctiption->fill($request->all());
        $requestPresctiption->user_id = Auth::user()->id;

        DB::beginTransaction();
        try {
            $requestPresctiption->save();

            if (!$requestPresctiption->id) {
                return redirect()->route('request-prescription.index');
            }

            $images = is_array($request->file('images')) ? $request->file('images') : [];

            foreach ($images as $image) {
                if (!$image) {
                    continue;
                }
               
                $image->hashName();
                $path = $image->store(RequestPrescription::PATH_REQUEST . $requestPresctiption->id, 'uploads');

                $imageModel = new Image;
                $imageModel->request_prescription_id = $requestPresctiption->id;
                $imageModel->path_origin = $path;
                $imageModel->is_main = 1;
                $imageModel->save();
            }
            
            $doctors = is_array($request->doctors) ? $request->doctors : [];

            foreach ($doctors as $doctor) {
                $relatedDoctorRequest = new RelatedDoctorRequest;
                
                $relatedDoctorRequest->doctor_id = $doctor;
                $relatedDoctorRequest->request_prescription_id = $requestPresctiption->id;
                $relatedDoctorRequest->save();
            }

            DB::commit();
            Helper::addMessageFlashFrontendSession(
                __('Success'),
                __('Add new request Prescription :name successfully!', ['name' => $requestPresctiption->title]),
                'success'
            );

            return redirect()->route('request-prescription.index');
        } catch (Exception $e) {
            DB::rollBack();
            Helper::addMessageFlashFrontendSession(__('Error'), $e->getMessage(), 'danger');

            return redirect()->route('request-prescription.addnew')->withInput($request->input);
        }  
    }

    public function doctorRequestIndex()
    {  
        if (Auth::user()->permission != User::PERMISSION_DOCTER) {
            return redirect()->route('welcome');
        }

        $relatedDoctorRequests = RelatedDoctorRequest::where('doctor_id', Auth::user()->id)
            ->with('getRequestPrescription.getAllImages')
            ->with('getRequestPrescription.getAllPrescription')
            ->with('getRequestPrescription.getUser')
            ->orderBy('id', 'desc')
            ->paginate(config('model.request_prescription.items_limit'));

        $optionStatus = RelatedDoctorRequest::getOptionStatus();

        return view('frontend.doctor.request-prescription-index', compact(['relatedDoctorRequests', 'optionStatus']));
    }
}
