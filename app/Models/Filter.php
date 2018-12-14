<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/11
 * Time: 19:52
 */

namespace App\Models;

use Couchbase\GeoDistanceSearchQuery;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table='Filter';

    protected $primaryKey='filter_id';

    protected $fillable=['uid','filter_name','from_who','location_filter_id','state','time','date'];


    public function tags()
    {
        return $this->belongsToMany(Tag::class,'Filter_Tag','filter_id','tid');
    }

    public function states()
    {
        return $this->belongsToMany(State::class,'Filter_Tag','filter_id','stateid');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'uid');
    }

    public function location()
    {
        return $this->belongsTo(Filter_location::class, 'location_filter_id');
    }

    static public function get_lastest_filter($user)
    {
        #todo 这里的log到底要干嘛
//        $entry=Log::where('uid',$user->uid)->orderBy('created_at','desc')->first();
        #  根据我们的流程，这里可以保证会搜索到一条filter。
        $filter=Filter::where('uid',$user->uid)->orderBy('created_at','desc')->first();
//        $defaultFilter=new Filter;
//        $defaultFilter->uid=$user->uid;
//        $defaultFilter->from_who=0;
//        $defaultFilter->location()->create([
//            'latitude'=>$entry->latitude,
//            'longitude'=>$entry->longitude,
//            'radius'=>500,
//        ]);
//        $defaultFilter->save();
        return $filter;
    }

    static public function get_notes_by_location($location)
    {
//        return Note::all();

        $longitude=$location->longitude;
        $latitude=$location->latitude;
        $radius=$location->radius;
//        $radius=5000; //geohash 精度是4890-610-153 不如直接用5000 5位

        //Note 的longitude 和latiduet 有值为空
        $geohash=Geohash::encode($latitude,$longitude);
        $geohashTop=Geohash::adjacent($geohash,'top');
        $geohashRight=Geohash::adjacent($geohash,'right');
        $geohashBottom=Geohash::adjacent($geohash,'bottom');
        $geohashLeft=Geohash::adjacent($geohash,'left');
        $geohashTopleft=Geohash::adjacent($geohashTop,'left');
        $geohashTopright=Geohash::adjacent($geohashTop,'right');
        $geohashBottomleft=Geohash::adjacent($geohashBottom,'left');
        $geohashBottomright=Geohash::adjacent($geohashBottom,'right');
        $geohashList=[
            substr($geohash,0,5),
            substr($geohashTop,0,5),
            substr($geohashRight,0,5),
            substr($geohashLeft,0,5),
            substr($geohashBottom,0,5),
            substr($geohashTopleft,0,5),
            substr($geohashTopright,0,5),
            substr($geohashBottomright,0,5),
            substr($geohashBottomleft,0,5),
        ];
        $geohashList=array_unique($geohashList);
        $notes=[];
        foreach ($geohashList as $item) {
            $notes=array_merge($notes,Note::where('geohash','like',$item.'%')->get()->all());
        }
//        return $notes;
        $filtered_notes=[];
        foreach ($notes as $note){
            if(Geohash::checkDistanceValid($note,$latitude,$longitude,$radius)){
                array_push($filtered_notes,$note);
            }
        }
        return $filtered_notes;
    }

    static public function filter_by_from_who($notes,$from_who,$user)
    {
        if(!$notes){
            return [];
        }

        $filtered_notes=[];
        foreach($notes as $note){
            if($from_who===0){
                array_push($filtered_notes,$note);
            }
            elseif($from_who===1){
                if($note->uid===$user->uid){
                    array_push($filtered_notes,$note);
                }
            }
            else{
                if($user->friends->pluck('uid')->contains($note->uid)){
                    array_push($filtered_notes,$note);
                }
            }
        }
//        return Note::all();
        return $filtered_notes;
    }

    static public function filter_by_permission($notes,$user)
    {
        if(!$notes){
            return [];
        }

        $filtered_notes=[];
        foreach($notes as $note){
            if($note->permission===0){
                array_push($filtered_notes,$note);
            }
            elseif($note->permission===1){
                if($note->uid===$user->uid){
                    array_push($filtered_notes,$note);
                }
            }
            else{//only friends include self
                if($note->user()->first()->friends()->pluck('uid')->contains($user->uid)){
                    array_push($filtered_notes,$note);
                }
                if($note->uid===$user->uid){
                    array_push($filtered_notes,$note);
                }
            }
        }
        return $filtered_notes;

    }

    static public function filter_by_keyword($notes,$keyword)
    {
        $filtered_notes=[];
        foreach ($notes as $note){
            if(strstr($note->notetext,$keyword)){
                array_push($filtered_notes,$note);
            }
        }
        return $filtered_notes;
    }

    static public function filter_by_tags($notes,$tags)
    {
        //需要全部都包含tag才行。
        if(!$notes){
            return [];
        }
        if(!$tags){
            return $notes;
        }

        $filtered_notes=[];
        foreach ($notes as $note){
            $noteTags=$note->tags()->pluck('Tag.tid'); //这里的用法特别不一样用tid的话，会ambiguous

            if(!$noteTags){
                array_push($filtered_notes,$note);
                break;
            }

            $isAllContain=true;
            foreach ($tags->get() as $tag){
                if(!$noteTags->contains($tag->tid)){
                    $isAllContain=false;
                    break;
                }
            }
            if($isAllContain){
                array_push($filtered_notes,$note);
            }


        }
        return $filtered_notes;
    }

    static public function filter_by_states($notes,$state)
    {
        if(!$notes){
            return [];
        }
        if(!$state){
            return $notes;
        }

        $filtered_notes=[];
        foreach ($notes as $note){
            if(strstr($note->states,$state)){
                array_push($filtered_notes,$note);
            }
        }

        return $filtered_notes;
    }

    static public function filter_by_time($notes,$time,$date)
    {
        if(!$notes){
            return [];
        }

        $filtered_notes=[];

        foreach ($notes as $note)
        {
            $repeat=$note->repeats->first();
            if($repeat)
            {
                if($time>$repeat->day_start && $time<$repeat->day_end)
                {
                    if($repeat->repeat_interval>0)
                    {
                        $begin=date_create($note->begin_date);
                        $filter_date=date_create($date);
                        $diff=date_diff($begin,$filter_date)->format('%a');
                        if($diff%$repeat->repeat_interval==0)
                        {
                            array_push($filtered_notes,$note);
                        }
                    }
                    elseif (($repeat->repeat_year==0 || $repeat->repeat_year==(date("Y",strtotime($note->begin_date))-date("Y",strtotime($date))))
                        && ($repeat->repeat_month==0 || $repeat->repeat_month==date("n",strtotime($date)))
                        && ($repeat->repeat_week==0 || $repeat->repeat_week==ceil(date("j",strtotime($date))/7))
                        && ($repeat->repeat_weekday==0 || $repeat->repeat_weekday==date("N",strtotime($date))))
                    {
                        array_push($filtered_notes,$note);
                    }
                }
            }
            else
            {
                array_push($filtered_notes,$note);
            }

        }

        return $filtered_notes;
    }



    static public function get_valid_notes($user)
    {
        $geohash=Log::get_lastest_geohash($user);
        $filter=self::get_lastest_filter($user);        //因为每次调用一定会在log中写入文件，可以保证一定会有一个filter返回


        $notes=self::get_notes_by_location($filter->location()->first());
        $notes=self::filter_by_from_who($notes,$filter->from_who,$user);
        $notes=self::filter_by_permission($notes,$user);
        $notes=self::filter_by_tags($notes,$filter->tags());
        $notes=self::filter_by_states($notes,$filter->state);
        $notes=self::filter_by_time($notes,$filter->time,$filter->date);
        return $notes;

    }

}