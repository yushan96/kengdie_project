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
//        $feed_items=[];
//        if(Auth::check())
//        {
//            $feed_items=Auth::user()->feed()->paginate(10);
//        }
//        return redirect()->route('home', [Auth::user()]);
        return view('static_pages/home', compact('feed_items'));
    }
    //
}
