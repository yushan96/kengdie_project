<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/11
 * Time: 23:41
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class State extends Model
{
    protected $table='State';

    protected $primaryKey='stateid';

    protected $fillable=['uid','state_text'];
    public $timestamps = false;


    public function notes()
    {
        return $this->belongsToMany(Note::class,'Note_State','stateid','noteid')->get();
    }
}