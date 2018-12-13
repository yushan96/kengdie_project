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

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function friends()
    {
//        status=1 代表accepted
        return $this->belongsToMany(User::class, 'friendships', 'uid1', 'uid2')
            ->where('status', '=', 1)
            ->withTimestamps()->withPivot('status');
//        $friendID=Friendship::where('uid1','=',$this->uid)->where('status','=',1)->pluck('uid2')->toArray();
//        return User::whereIn('uid',$friendID)->get();   //直接取出全部User
    }

    public function deleteFriend($user_ids)
    {
        if(!is_array($user_ids))  {
            $this_ids=compact('user_ids');

        }
        $this->friends()->detach($user_ids);
//        Friendship::where('uid1', $this->uid)->where('uid2', $user_id)->delete();
    }

    public function isFriend($user_id)
    {

        foreach ($this->friends() as $friend) {
            if ($friend->uid === $user_id) {
                return true;
            }
        }
        return false;
    }

    public function requests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'uid1', 'uid2')
            ->where('status', '=', 0)
            ->withTimestamps()->withPivot('status');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function filters()
    {
        return $this->hasMany(Filter::class,$this->primaryKey,'uid');
    }
}
