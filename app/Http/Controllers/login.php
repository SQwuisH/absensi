<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class login extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postlogin (Request $request)
    {
        if (Auth::attempt($request->only('email','password')))
        {
            return redirect('/');
        }
        else return back()->with('error', 'Something went wrong!');
    }
}
