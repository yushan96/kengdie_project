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

    protected $fillable=['notetext','permission','begin_date','end_date'];


    public function user()
    {
        return $this->belongsTo(User::class,'uid','','');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'Note_Tag','noteid','tid')->get();
    }



    public function add_tag($tids)
    {
        if(!is_array($tids))
        {
            $tids=compact('noteid');
        }
        $this->tags()->sync($tids,false);
    }

    public function has_tag($tids)
    {
        return $this->tags()->contains($tids);
    }

    public function repeats()
    {
        return $this->hasMany(NoteRepeat::class,$this->primaryKey,'noteid')->get();

    }
}