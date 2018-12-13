<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/11
 * Time: 19:52
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //每filter apply 一次，然后就记录一个log
    protected $table='Log';

    protected $primaryKey='log_id';

    protected $fillable=['log_id','uid','log_date','log_time','latitude','longitude','geohash','filter_id'];

    public $timestamps;

    static public function get_lastest_geohash($user)
    {
        $entry=Log::where('uid',$user->uid)->orderBy('created_at','desc')->first();
        if($entry){
            return $entry->geohash;
        }
        return null;
    }



}