<?php

namespace App\Http\Controllers;

use App\Policies\FriendshipPolicy;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friendship;
use Auth;

class FriendshipController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function requests(User $user)
    {
        $requests=$user->requests()->paginate(30);
        $title='friend request';
        return view('users.show_friend_requests',compact('requests','title'));
    }

    public function acceptRequest(User $user, Request $request)
    {
        $friendship=Friendship::where('uid1','=',Auth::user()->uid)->
            where('uid2',$user->uid)->first();

        $friendship->status=1;
        $friendship->save();
        Friendship::create([
            'uid1'=>$user->uid,
            'uid2'=>Auth::user()->uid,
            'status'=>1,
        ]);
        session()->flash('success','Accept friend request success!');
        return redirect()->back();
    }



    public function denyRequest(User $user, Request $request)
    {
        Friendship::where('uid1','=',Auth::user()->uid)->
        where('uid2',$user->uid)->delete();
        session()->flash('success','Deny friend request success!');
        return redirect()->back();
    }




//    public function request($user_id)
//    {
//        return $this->
//
////        todo: 如果已经存在在表当中了呢
//        $newFriendship = new Friendship;
//        $newFriendship->uid1 = $this->uid;
//        $newFriendship->uid2 = $user_id;
//        $newFriendship->status = 0;
//        $newFriendship->save();
//    }
//
//    public function acceptFriend($user_id)
//    {
//
//    }
//
//    public function denyFriend($user_id)
//    {
//
//    }
    public function newFriends()
    {
        return $this->belongsToMany(User::class, 'friendships','uid1','uid2')
            ->where('status','<>',1)
            ->withTimestamps()->withPivot('status');
    }
}
