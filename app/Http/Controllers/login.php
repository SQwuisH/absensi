<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\User;
use App\Models\wali;
use App\Models\wali_siswa;
use Database\Seeders\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class login extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Mencari pengguna di tabel User berdasarkan NIS
        if ($siswa = siswa::where('nis', $request->identifier)->first()) {
            $user = User::find($siswa->id_user); // Pastikan ada relasi antara Siswa dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect('/');
            }
        }
        // Mencari pengguna di tabel User berdasarkan NIK
        elseif ($waliSiswa = wali_siswa::where('nik', $request->identifier)->first()) {
            $user = User::find($waliSiswa->id_user); // Pastikan ada relasi antara walisiswa dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect('/');
            }
        }
        // Mencari pengguna di tabel User berdasarkan NUPTK
        elseif ($waliKelas = wali::where('nuptk', $request->identifier)->first()) {
            $user = User::find($waliKelas->id_user); // Pastikan ada relasi antara walikelas dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect('/');
            }
        }
        // Mencari pengguna di tabel User berdasarkan Email
        elseif ($user = User::where('email', $request->identifier)->first()) {
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect('/');
            }
        }

        return back()->withErrors([
            'identifier' => 'Data login tidak valid.',
        ]);
    }
}
