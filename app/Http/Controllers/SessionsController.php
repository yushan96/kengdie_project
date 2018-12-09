<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/8
 * Time: 18:07
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            //success
            session()->flash('success', 'Welcome！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            //fail
            session()->flash('danger', 'Wrong email or password');
            return redirect()->back();
        }

    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'Sign out success！');
        return redirect('login');
    }
}