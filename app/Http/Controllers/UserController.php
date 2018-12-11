<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Friendship;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store','index']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy',$user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    public function show(User $user)
    {
        $notes=$user->notes()->orderBy('created_at','desc')->paginate(10);
        return view('users.show',compact('user','notes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:User|max:50',
            'address'=>'max:200',
            'password' => 'required|confirmed|min:6'
        ]);
        $user=User::create([
            'uname'=>$request->name,
            'email'=>$request->email,
            'uaddress'=>$request->address,
            'password'=>bcrypt($request->password),
        ]);

        session()->flash('Success','Welcome to oingo');
        return redirect()->route('users.show',[$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $this->authorize('update', $user);

        $data = [];
        $data['uname'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', 'Update success！');

        return redirect()->route('users.show', $user->uid);
    }

    public function friends(User $user)
    {
        $friends=$user->friends()->paginate(30);
        $title='friend list';
        return view('users.show_friends',compact('friends','title'));

    }

    public function unfriend(User $user)
    {
//        $this->authorize('unfriend','user');
        Friendship::unfriend(Auth::user(),$user);
        session()->flash('success', 'unfriend success！');
        return redirect()->back();
    }
    //
}
