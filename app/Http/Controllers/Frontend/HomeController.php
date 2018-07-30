<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Eloquent\Medicine;
use App\Eloquent\User;
use App\Eloquent\Image;
use App\Eloquent\Category;
use App\Eloquent\MarkMedicine;
use App\Eloquent\InforWebsite;
use App\Eloquent\RateMedicine;
use App\Helpers\Helper;
use App\Mail\ContactAdmin;
use Session;
use Response;
use Auth;
use DB;

class HomeController extends Controller
{

    public function changeLanguage(Request $request)
    {
        $lang = $request->language;

        $language = 'vn';
        if ($lang == 'en') {
            $language = 'en';
        }

        Helper::setLanguage($language);

        return redirect()->back();
    }

    public function index()
    {   
        $queryRate = RateMedicine::with('getUser', 'getMedicine')->whereNotNull('user_id')
            ->orderBy('point_rate', 'desc')->orderBy('id', 'desc');
        for ($i = 0; $i < 3; $i++) {
            $data['review'][$i] = $queryRate->take(3)->skip(3*$i)->get();
        }

        return view('frontend.home.index', compact(['data']));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $items = Medicine::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('symptom', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->paginate(config('model.medicine.result_limit'));
        $option['allowedToBuy'] = Medicine::getOptionAllowedBuy();
        
        return view('frontend.search.result', compact(['items', 'keyword', 'option']));
    }

    public function jsonSearch(Request $request)
    {
        $keyword = $request->keyword;

        $medicines = Medicine::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('symptom', 'like', '%' . $keyword . '%')
            ->take(config('model.medicine.autocomple_limit'))
            ->orderBy('id', 'desc')->get();
       
        return Response::json($medicines);
    }

    public function markMedicineIndex()
    {
        $marks = MarkMedicine::with('getMedicine.getAllImages')
            ->with('getMedicine.getAllRateMedicines')
            ->with('getMedicine.getAllComments')
            ->getMarkByUser(Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(config('model.mark_medicine.items_limit'));

        return view('frontend.mark-medicine.list', compact(['marks']));
    }

    public function markMedicineDestroy($id)
    {
        $mark = MarkMedicine::find($id);

        if (!$mark || ($mark->user_id != Auth::user()->id)) {
            return redirect()->route('frontend.mark-medicine.index');
        }

        DB::beginTransaction();
        try {
            $mark->delete();
            DB::commit();
            Helper::addMessageFlashFrontendSession(__('Success'), __('Delete successfully!'), 'success');
        } catch (Exception $e) {
            DB::rollBack();
            Helper::addMessageFlashFrontendSession(__('Error'), $e->getMessage(), 'danger');
        }

        return redirect()->route('frontend.mark-medicine.index');
    }

    public function indexSendEmail()
    {
        return view('frontend.contact.sendEmail');
    }

    public function sendEmail(Request $request)
    {
        $data['name'] = $request->firstname;
        $data['email'] = $request->email;
        $data['message'] = $request->message;
        Mail::to(Helper::getEmailContactTo())->send(new ContactAdmin($data));

        Helper::addMessageFlashFrontendSession(__('Success'), __('Send email to Admin successfully!'), 'success');

        return redirect()->route('frontend.contact.index');
    }

    public function doctorList()
    {
        $genderOption = User::getGenderOption();

        return view('frontend.doctor.list-doctor', compact(['genderOption']));
    }

    public function jsonDoctorList(Request $request)
    {
        $keyword = $request->keyword;
        $doctors = User::where('permission', User::PERMISSION_DOCTER)
            ->where('display_name', 'like', '%' . $keyword . '%')
            ->orWhere('position', 'like', '%' . $keyword . '%')
            ->orWhere('specialize', 'like', '%' . $keyword . '%')
            ->orWhere('certificate', 'like', '%' . $keyword . '%')
            ->orWhere('experience', 'like', '%' . $keyword . '%')
            ->orWhere('workplace', 'like', '%' . $keyword . '%')
            ->where('permission', User::PERMISSION_DOCTER)
            ->paginate(config('model.user.doctor_limit'));
            
        return  Response::json($doctors);
    }
}
