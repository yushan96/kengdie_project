<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/9
 * Time: 21:21
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table='Note';

    protected $primaryKey='noteid';

    protected $fillable=['notetext','permission','begin_date','end_date','longitude','latitude','radius','geohash'];


    public function user()
    {
        return $this->belongsTo(User::class,'uid','','');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'Note_Tag','noteid','tid')->get();
    }

    public function repeats()
    {
        return $this->hasMany(NoteRepeat::class,$this->primaryKey,'noteid')->get();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,$this->primaryKey,'noteid');
    }

    public function states()
    {
        return $this->belongsToMany(State::class,'Note_State','noteid','stateid');
    }
}