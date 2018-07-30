<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Comment;
use App\Helpers\Helper;

class CommentController extends Controller
{
    
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->comment->with('getUser', 'getMedicine')
            ->with('getChildrenComment.getUser', 'getChildrenComment.getMedicine')
            ->with(['getChildrenComment' => function($query){
                $query->orderBy('id', 'desc');
            }])
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')->paginate(5);
        $data['comments'] = $comments;

        return view('admin.comment.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $comment = $this->comment->with('getUser', 'getMedicine')->find($id);
        if (!$comment) {
            $message = __('Comment not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');
            
            return redirect()->route('comment.index');
        }
        $optionStatus = $this->comment->getOptionStatus();

        return view('admin.comment.edit', compact(['comment', 'optionStatus']));
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
        $comment = $this->comment->find($id);
        if (!$comment) {
            $message = __('Comment not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');
            
            return redirect()->route('comment.index');
        }

        $comment->fill($request->only(['status']));
        try {
            $comment->save();
            $message = __('Save successfully!');
            Helper::addMessageFlashSession(__('Success'), $message, 'success');
        } catch(Exception $e) {
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
        }

        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->comment->with('getUser', 'getMedicine')->find($id);
        if (!$comment) {
            $message = __('Comment not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');
            
            return redirect()->route('comment.index');
        }

        try {
            $comment->delete();
            $message = __('Delete comment from :medicine of :user successfully!', [
                'medicine' => $comment->getMedicine->name,
                'user' => $comment->getUser->display_name,
            ]);
            Helper::addMessageFlashSession(__('Success'), $message, 'success');
        } catch(Exception $e) {
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
        }

        return redirect()->route('comment.index');
    }
}
