<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/10
 * Time: 23:00
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Note_Tag extends Model
{
    protected $table='Note_Tag';
    protected $fillable=['noteid','tid'];
    public $timestamps = false;
}