<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    //
    protected $table = 'friendships';
    protected $fillable=[
        'uid1','uid2','status'
    ];

    static public function isFriend(User $user1, User $user2)
    {
        $friendship=Friendship::where('uid1','=',$user1->uid)->where('uid2','=',$user2->uid)->where('status','=',1)->get();
        if (count($friendship)>0){
            return true;
        }
        return false;

    }

    static public function unfriend(User $user1, User $user2)
    {
        $friendship=Friendship::where('uid1','=',$user1->uid)->where('uid2','=',$user2->uid)->where('status','=',1);
        $friendship->delete();
        $friendship=Friendship::where('uid1','=',$user2->uid)->where('uid2','=',$user1->uid)->where('status','=',1);
        $friendship->delete();

    }

    static public function befriend(User $user1, User $user2)
    {
        Friendship::create([
            'uid1'=>$user1->uid,
            'uid2'=>$user2->uid,
            'status'=>0,
        ]);

    }
}
