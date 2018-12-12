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
use App\Models\NoteRepeat;
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

        $uid=Auth::user()->id;

        $note=Auth::user()->notes()->create([
            'uid' => $uid,
            'notetext' => $request->notetext,
            'begin_date'=>$request->begin_date,
            'end_date'=>$request->end_date,
            'permission'=>$request->permission,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        $noteid=$note->noteid;

        $tag=$request->input('tag');

        foreach ($tag as $tagid){
            $note_tag = new Note_Tag;
            $note_tag->noteid = $noteid;
            $note_tag->tid = $tagid;
            $note_tag->save();
        }

        if($request->repeat_year>0 || $request->repeat_month>0 || $request->week>0){
            $noterepeat=new NoteRepeat;
            $noterepeat->noteid = $noteid;
            $noterepeat->repeat_start=$request->repeat_start;
            $noterepeat->repeat_interval=-1;
            $noterepeat->repeat_year=$request->repeat_year;
            $noterepeat->repeat_month=$request->repeat_month;
            $noterepeat->repeat_week=$request->repeat_week;
            $noterepeat->repeat_weekday=$request->repeat_weekday;
            $noterepeat->day_start=$request->day_start;
            $noterepeat->day_end=$request->day_end;
            $noterepeat->save();
        }
        else{
            $noterepeat=new NoteRepeat;
            $noterepeat->noteid = $noteid;
            $noterepeat->repeat_start=$request->repeat_start;
            $noterepeat->repeat_interval=$request->repeat_interval;
            $noterepeat->repeat_year=-1;
            $noterepeat->repeat_month=-1;
            $noterepeat->repeat_week=-1;
            $noterepeat->repeat_weekday=-1;
            $noterepeat->day_start=$request->day_start;
            $noterepeat->day_end=$request->day_end;
            $noterepeat->save();
            session()->flash('success', $request->interval);
        }

        return redirect()->route('users.show',Auth::user()->uid);
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