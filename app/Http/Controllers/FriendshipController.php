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

    public function storeRequest(Request $request)
    {
        $this->validate($request,[
            'uid' =>'required',
        ]);

        $friendship=Friendship::create([
            'uid1'=> Auth::user()->uid,
            'uid2'=> $request['uid']]);
        return redirect()->back();
    }

//
//    public function denyRequest($user)
//    {
//
//    }
//
//    public function acceptRequest($user)
//    {
//
//    }


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
