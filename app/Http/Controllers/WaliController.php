<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliController extends Controller
{
    public function index()
    {
        return view('kesiswaan.index');
    }
}
