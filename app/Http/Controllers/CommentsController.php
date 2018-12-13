<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/11
 * Time: 21:53
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Note;
use App\Models\User;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Comment $comment)
    {

        $this->validate($request, [
            'commenttext' => 'required|max:1000',
        ]);
        $comment->commenttext = $request->commenttext;
        $comment->uid = Auth::user()->uid;
        $comment->noteid = $request->noteid;
        $comment->save();

        return redirect()->back()->with('success', '创建成功！');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();

        return redirect()->back()->with('success', '删除成功！');
    }

    public function replystore(Request $request,Comment $comment)
    {
        $this->validate($request, [
            'commenttext' => 'required|max:1000',
        ]);
        $comment->commenttext = $request->commenttext;
        $comment->uid = Auth::user()->uid;
        $comment->noteid = $request->noteid;
        $comment->replyid=$request->commentid;
        $comment->save();

        return redirect()->back()->with('success', '创建成功！');
    }

    public function replydestroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();

        return redirect()->back()->with('success', '删除成功！');
    }

}