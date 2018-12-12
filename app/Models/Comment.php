<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/11
 * Time: 19:52
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='Comment';

    protected $primaryKey='commentid';

    protected $fillable=['noteid','uid','replyid','commenttext'];

    public $timestamps = false;

    public function note()
    {
        return $this->belongsTo(Note::class,'noteid','','');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'uid');
    }

    public function reply()
    {
        return $this->belongsTo(Comment::class,'commentid');
    }

}