<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
    public function show(User $user)
    {
        return view('users.show',compact('user'));
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
            'password_hash'=>bcrypt($request->password),
        ]);

        session()->flash('Success','Welcome to oingo');
        return redirect()->route('users.show',[$user]);
    }
    //
}
