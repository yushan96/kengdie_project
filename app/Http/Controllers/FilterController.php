<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/11
 * Time: 21:53
 */

namespace App\Http\Controllers;

use App\Models\Filter_location;
use App\Models\Filter_Tag;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Note;
use App\Models\User;
use App\Models\Comment;
use App\Models\Filter;
use Auth;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show()
    {

        $user=Auth::user();

        $notes=Filter::get_valid_notes($user);
        return  view('users.show_filter',compact('notes','user'));
    }

    public function filter_keyword(Request $request)
    {
        $user=Auth::user();
        $notes=Filter::get_filtered_notes($user);
        $keyword=$request->keyword;
        $notes=Filter::filter_by_keyword($notes,$keyword);
        return  view('show_filter',compact('notes','user'));
    }

    public function create()
    {
        $user=Auth::user();
        $filter=Filter::get_lastest_filter($user);
        return view('filters.create',compact('filter'));
    }


    public function store(Request $request)
    {
        $longitude=$request->longitude;
        $latitude=$request->latitude;
        $uid=Auth::user()->uid;
        $radius=$request->radius;
        $from_who=$request->from_who;
        $tags=$request->input('tag');
        $state=$request->state;
        $time=$request->time;
        $date=$request->date;
//        $keywords=$request->keywords;

        $location_filter=new Filter_location();
        $location_filter->latitude=$latitude;
        $location_filter->longitude=$longitude;
        $location_filter->radius=$radius;
        $location_filter->save();


        $filter=Auth::user()->filters()->create([
            'uid'=>$uid,
            'from_who'=>$from_who,
            'location_filter_id'=>$location_filter->location_filter_id,
            'time'=>$time,
            'date'=>$date,
            'state'=>$state,

        ]);

        $filter_id=$filter->filter_id;
        if($tags)
        {
            foreach($tags as $tag)
            {
                $filter_tag=new Filter_Tag;
                $filter_tag->filter_id=$filter_id;
                $filter_tag->tid=$tag;
                $filter_tag->save();
            }
        }


        return redirect('filter');
    }

}