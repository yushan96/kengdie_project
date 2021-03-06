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
            where('uid2',$user->uid)->get();

        foreach($friendship as $friend){
            $friend->delete();
        }
        $friendship=Friendship::where('uid2','=',Auth::user()->uid)->
        where('uid1',$user->uid)->get();

        foreach($friendship as $friend){
            $friend->delete();
        }
//        $friendship->status=1;
//        $friendship->save();
        Friendship::create([
            'uid1'=>$user->uid,
            'uid2'=>Auth::user()->uid,
            'status'=>1,
        ]);
        Friendship::create([
            'uid2'=>$user->uid,
            'uid1'=>Auth::user()->uid,
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


    public function newFriends()
    {
        return $this->belongsToMany(User::class, 'friendships','uid1','uid2')
            ->where('status','<>',1)
            ->withTimestamps()->withPivot('status');
    }
}
