<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/12
 * Time: 0:02
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Note_State extends Model
{
    protected $table='Note_State';
    protected $fillable=['noteid','stateid'];
    public $timestamps = false;
}