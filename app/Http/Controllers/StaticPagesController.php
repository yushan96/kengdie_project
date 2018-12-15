<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Note;
use Auth;

class StaticPagesController extends Controller
{
    public function home()
    {
        $notes=[];
        if(Auth::check())
        {
            $notes=Auth::user()->notes()->paginate(10);
        }
//        return redirect()->route('home', [Auth::user()]);
        return view('static_pages/home', compact('notes'));
    }
    //
}
