<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Eloquent\Category;
use App\Eloquent\Image;
use App\Eloquent\Medicine;
use App\Eloquent\RateMedicine;
use App\Eloquent\MarkMedicine;
use App\Eloquent\Comment;
use App\Eloquent\User;
use Response;
use View;
use Auth;

class DetailMedicinesController extends Controller
{
    public function index(Request $request, $id)
    {
        $medicine = Medicine::with('getAllImages')->find($id);
        if (!$medicine) {
            return redirect()->route('welcome');
        }
        
        $collectionRate = RateMedicine::where('medicine_id', $id)->get();
        $countStar = [];
        $avgMedicine = $collectionRate->avg('point_rate');
        $countTotalRate = count($collectionRate);
        for ($i=1; $i<6; $i++) {
            $countStar[] = count(RateMedicine::StarNumber($id, $i)->get());
        }

        $reviewInformation = RateMedicine::GetRateId($medicine->id)
            ->with('getUser')->orderBy('id', 'desc')
            ->paginate(config('model.medicine.review_limit'));

        if ($request->ajax()) {
            return view('frontend.components.reviews', compact(['reviewInformation', 'collectionRate', 'countStar', 'medicine']));
        }
        $option['allowedToBuy'] = $medicine->getOptionAllowedBuy();
        $check_marked = [];
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $medicine_id = $medicine->id;
            $check_marked = MarkMedicine::checkMarkMedicine($user_id, $medicine_id)->first();
        }

        return view('frontend.medicine.detail', [
            'medicine' => $medicine,
            'check_marked' => $check_marked,
            'collectionRate' => $collectionRate,
            'countStar' => $countStar,
            'reviewInformation' => $reviewInformation,
            'option' => $option
            ]);
    }
    public function reviewMedicine(Request $request, $id) {

        $rate_medicines = new RateMedicine;
        $rate_medicines->user_id = Auth::check() ? Auth::user()->id : NULL;
        $rate_medicines->medicine_id = $id;
        $rate_medicines->point_rate = $request->input('star_main');
        $rate_medicines->title = $request->input('review_title');
        $rate_medicines->content = $request->input('review_content');
        $rate_medicines->save();

        $collectionRate = RateMedicine::where('medicine_id', $id)->get();
        //total rate
        $avgMedicine = $collectionRate->avg('point_rate');
        $countTotalRate = count($collectionRate);

        $medicine = Medicine::find($id);
        $medicine->avg_rate = $avgMedicine;
        $medicine->total_rate = $countTotalRate;
        $medicine->save();
        
        $collectionRate = RateMedicine::where('medicine_id', $id)->get();
        $countStar = [];
        for ($i=1; $i<6; $i++) {
            $countStar[] = count(RateMedicine::StarNumber($id, $i)->get());
        }

        $reviewInformation = RateMedicine::GetRateId($id)
            ->with('getUser')->orderBy('id', 'desc')
            ->paginate(config('model.medicine.review_limit'));

        return view('frontend.components.reviews', compact(['reviewInformation', 'collectionRate', 'countStar', 'medicine']));
    }

    public function addToBox(Request $request) {
        $medicine_id = $request->medicine_id;
        $user_id = Auth::user()->id;

        $check_added = MarkMedicine::checkMarkMedicine($user_id, $medicine_id)->first();

        if (!empty($check_added->id))
        {
            $check_added->delete();

            return __('<i class="fa fa-heart-o" aria-hidden="true"></i>');
        }

        $mark_medicines = new MarkMedicine;
        $mark_medicines->user_id = $user_id;
        $mark_medicines->medicine_id= $medicine_id;
        $mark_medicines->save();

        return __(' <i class="fa fa-heart" aria-hidden="true"></i>');
    }

    public function jsonCommentList(Request $request)
    {
        $user_id = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $medicineId = $request->medicineId;

        $comments = Comment::with('getUser')
            ->with('getChildrenComment.getUser')
            ->with(['getChildrenComment' => function ($query) {
                $query->where('status', Comment::STATUS_ENABLE)->orderBy('id', 'desc');
            }])
            ->whereNull('parent_id')
            ->where('medicine_id', $medicineId)
            ->where('status', Comment::STATUS_ENABLE)
            ->orderBy('id', 'desc')
            ->paginate(config('model.comment.items_limit'));

        $data['comments'] = $comments;
        $data['currentUserId'] = $user_id;
        $data['optionPermission'] = User::getPermissionOption();

        return Response::json($data);
    }

    public function addEditComment(Request $request)
    {
        $comment_id = $request->id;
        $medicine_id = $request->medicineId;
        $user_id = Auth::user()->id;

        if (!$comment_id) {
            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->medicine_id = $medicine_id;
        } else {
            $comment = Comment::find($comment_id);
        }
        
        $comment->content = $request->content;
        $comment->save();

        $comments = Comment::with('getUser')->with('getChildrenComment.getUser')
            ->with(['getChildrenComment' => function ($query) {
                $query->where('status', Comment::STATUS_ENABLE)->orderBy('id', 'desc');
            }])
            ->whereNull('parent_id')
            ->where('medicine_id', $medicine_id)
            ->where('status', Comment::STATUS_ENABLE)
            ->orderBy('id', 'desc')
            ->paginate(config('model.comment.items_limit'));

        $data['comments'] = $comments;
        $data['currentUserId'] = $user_id;
        $data['optionPermission'] = User::getPermissionOption();

        return Response::json($data);
    }

    public function addEditChildrenComment(Request $request)
    {
        $user_id = Auth::user()->id;
        $medicine_id = $request->medicineId;
        $parent_id = $request->parent_id;
        $comment_id = $request->id;

        if (!$comment_id) {
            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->medicine_id = $medicine_id;
            $comment->parent_id = $parent_id;
        } else {
            $comment = Comment::find($comment_id);
        }

        $comment->content = $request->content;
        $comment->save();

        $response = Comment::with('getUser')
            ->where('parent_id', $parent_id)
            ->where('medicine_id', $medicine_id)
            ->where('status', Comment::STATUS_ENABLE)
            ->orderBy('id', 'desc')->get();

        return Response::json($response);
    }

    public function deleteChildrenComment(Request $request)
    {
        $user_id = Auth::user()->id;
        $medicine_id = $request->medicineId;
        $parent_id = $request->parent_id;
        $comment_id = $request->id;
      
        $comment = Comment::find($comment_id);
        if ($comment) $comment->delete();

        $response = Comment::with('getUser')
            ->where('parent_id', $parent_id)
            ->where('medicine_id', $medicine_id)
            ->where('status', Comment::STATUS_ENABLE)
            ->orderBy('id', 'desc')->get();

        return Response::json($response);
    }
}
