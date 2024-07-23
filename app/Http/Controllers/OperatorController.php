<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        return view('operator.index');
    }

    public function wali()
    {
        return view('operator.wali');
    }

    public function kelas()
    {
        return view('operator.kelas');
    }

    public function koordinat()
    {
        return view('operator.koordinat');
    }

    public function absen()
    {
        return view('operator.absen');
    }

    public function jurusan()
    {
        return view('operator.jurusan');
    }
}
