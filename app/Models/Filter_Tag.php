<?php
/**
 * Created by PhpStorm.
 * User: macrovve
 * Date: 12/12/18
 * Time: 2:05 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Filter_Tag extends Model
{
    protected $table='Filter_Tag';
    protected $fillable=['filter_id','tid'];
    public $timestamps = false;
}