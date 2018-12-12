<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/9
 * Time: 23:43
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Note;
use App\Models\Note_Tag;
use Auth;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'notetext' => 'required|max:1000',
        ]);

        $noteid=Auth::user()->notes()->insertGetId([
            'notetext' => $request->notetext,
            'begin_date'=>$request->begin_date,
            'end_date'=>$request->end_date,
            'permission'=>$request->permission,
        ],'noteid');

        $tag=$request->input('tag');

        # todo 无tag会报错
        foreach ($tag as $tagid){
            $note_tag = new Note_Tag;
            $note_tag->noteid = $noteid;
            $note_tag->tid = $tagid;
            $note_tag->save();
        }

        return redirect()->back();
    }

    public function destroy(Note $note)
    {
        $this->authorize('destroy', $note);
        $note->delete();
        session()->flash('success', 'The note has been deleted！');
        return redirect()->back();
    }

    public function tags(Note $note)
    {
        $tags=$note->tags();
        $title='Tags of note';
        return view('notes.show_tag',compact('tags','title'));
    }

}