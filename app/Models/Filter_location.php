<?php
/**
 * Created by PhpStorm.
 * User: macrovve
 * Date: 12/12/18
 * Time: 2:06 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Filter_location extends Model
{
    protected $table='Filter_location';

    protected $primaryKey='location_filter_id';

    protected $fillable=['latitude','longitude','radius'];
    public $timestamps = false;


    public function filters()
    {
        return $this->belongsTo(Filter::class,'filter_id')->get();
    }
}