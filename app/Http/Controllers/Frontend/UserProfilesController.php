<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\User;
use App\Eloquent\Order;
use App\Eloquent\RateMedicine;
use App\Eloquent\Comment;
use App\Eloquent\RequestMedicine;
use App\Eloquent\RelatedDoctorRequest;
use App\Eloquent\Prescription;
use App\Helpers\Helper;
use Hash;
use Response;
use Validator;
use Auth;


class UserProfilesController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = Auth::user();

        $orderCollection = Order::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $data['orders']['list'] = $orderCollection;
        $data['orders']['pending'] = $orderCollection->where('status', Order::STATUS_PENDING);
        $data['orders']['complete'] = $orderCollection->where('status', Order::STATUS_COMPLETE);
        $data['orders']['cancel'] = $orderCollection->where('status', Order::STATUS_CANCEL);
        $data['orders']['refund'] = $orderCollection->where('status', Order::STATUS_REFUND);
        $data['orders']['options'] = Order::getOptionStatus();

        $data['review']['count'] = RateMedicine::select('id')->where('user_id', $user->id)->get()->count();
        $data['comment']['question'] = Comment::select('id')->getQuestionByUserId($user->id)->get()->count();
        $data['comment']['answer'] = Comment::select('id')->getAnswerByUserId($user->id)->get()->count();
        $data['request']['medicine'] = RequestMedicine::select('id')->where('user_id', $user->id)->get()->count();

        if ($user->permission == User::PERMISSION_DOCTER) {
            $data['doctor']['request'] = RelatedDoctorRequest::where('doctor_id', $user->id)->get()->count();
            $data['doctor']['prescription'] = Prescription::where('doctor_id', $user->id)->get()->count();
        }

        $option['gender'] = $this->user->getGenderOption();
        $option['permission'] = $this->user->getPermissionOption();

        return view('frontend.user.userProfile', compact(['option', 'data']));
    }

    public function editUserInformations(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'display_name' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect()
                ->route('frontend.user.profiles')
                ->withErrors($validator);
        }

        $user = User::find(Auth::user()->id);

        $user->fill($request->all());
        $user->save();

        return redirect()->route('frontend.user.profiles');
    }

    public function showUploadAvatar(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if( $request->hasFile('image_upload') ) {
            Helper::deleteFile($user->avatar);

            $nameFile = $request->image_upload->hashName();
            $path = $request->file('image_upload')->store(User::PATH_AVATAR, 'uploads');
            $user->avatar = $path;
            $user->save();
        }

        return redirect()->route('frontend.user.profiles');
    }

    public function userChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:4|max:30',
            'confirm_password' => 'required|same:new_password|min:4|max:30',
            ]);

        $user = User::find(Auth::user()->id);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $data['error']['status'] = true;
            $data['error']['old_password'] = $messages->first('old_password');
            $data['error']['new_password'] = $messages->first('new_password');
            $data['error']['confirm_password'] = $messages->first('confirm_password');

            return Response::json($data);
        }

        $data['error']['status'] = false;
        if (!Hash::check($request->old_password, $user->password)) {
            $data['error']['status'] = true;
            $data['error']['old_password'] = __('Old password not correct!');
        } else {
            $user->password = bcrypt($request->new_password);
            $user->save();
            $data['message'] = __('Change password successfully!');
        }

        return Response::json($data);
    }

    public function profileDiffUser($user_id)
    {
        if (Auth::check() && $user_id == Auth::user()->id) {

            return redirect()->route('frontend.user.profiles');
        }

        $userProfiles = User::find($user_id);
        $option['gender'] = $this->user->getGenderOption();
        $option['permission'] = $this->user->getPermissionOption();

        $data['review']['count'] = RateMedicine::select('id')->where('user_id', $user_id)->get()->count();
        $data['comment']['question'] = Comment::select('id')->getQuestionByUserId($user_id)->get()->count();
        $data['comment']['answer'] = Comment::select('id')->getAnswerByUserId($user_id)->get()->count();

        if ($userProfiles->permission == User::PERMISSION_DOCTER) {
            $data['doctor']['request'] = RelatedDoctorRequest::where('doctor_id', $user_id)->get()->count();
            $data['doctor']['prescription'] = Prescription::where('doctor_id', $user_id)->get()->count();
        }

        return view('frontend.user.diff-user-profile', compact(['userProfiles', 'option', 'data']));
    }
}
