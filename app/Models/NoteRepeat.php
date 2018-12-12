<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/10
 * Time: 17:05
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NoteRepeat extends Model
{
    protected $table='NoteRepeat';

    protected $primaryKey='repeatid';

    public $timestamps = false;

    protected $fillable = [
        'noteid', 'repeat_start','repeat_interval', 'repeat_year','repeat_month','repeat_week','repeat_weekday',
        'day_start','day_end'
    ];

    public function notes()
    {
        return $this->belongsTo(Note::class,'noteid','','')->get();
    }
}