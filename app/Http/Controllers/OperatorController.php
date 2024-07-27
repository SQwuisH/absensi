<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\wali;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        return view('operator.index');
    }

    public function wali()
    {
        $walikelas = db::table('users')->join('walis', 'id', '=', 'id_user')->join('kelas', 'walis.nuptk', '=', 'kelas.nuptk')->join('jurusans', 'kelas.id_jurusan', '=', 'jurusans.id_jurusan')->get();
        return view('operator.wali', compact('walikelas'));
    }

    public function tambahwali(Request $request)
    {
        if(strlen($request->password) > 0)
        {
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'wali'
            ]);

            wali::insert([
                'nuptk' => $request->nuptk,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        }
        else
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'wali'
            ]);

            wali::insert([
                'nuptk' => $request->nuptk,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        }

        return redirect()->back();
    }

    public function editwali()
    {
        return view('operator.wali', compact('walikelas'));
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
