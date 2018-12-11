<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table='User';

    protected $primaryKey='uid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uname', 'email','uaddress', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //public $timestamps = false;
    public function notes()
    {
        return $this->hasMany(Note::class,$this->primaryKey,'uid');
    }

    public function feed()
    {
        return $this->notes()->orderBy('created_at','desc');
    }


}
