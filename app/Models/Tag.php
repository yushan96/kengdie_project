<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/10
 * Time: 13:28
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table='Tag';

    protected $primaryKey='tid';

    public $timestamps = false;

    public function notes()
    {
        return $this->belongsToMany(Note::class,'Note_Tag','tid','noteid')->get();
    }

}