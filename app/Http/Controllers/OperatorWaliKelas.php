<?php

namespace App\Http\Controllers;

use App\Exports\formatWaliKelas;
use App\Imports\waliSiswaImpor;
use App\Models\User;
use App\Models\wali;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OperatorWaliKelas extends Controller
{
    //WALI KELAS
    public function index()
    {
        $walikelas = wali::with('user', 'kelas', 'jurusan')->get();

        return view('operator.walikelas.index', compact('walikelas'));
    }

    public function add(Request $request)
    {
        $user = '';
        if (strlen($request->password) > 0) {
            $user = User::create([
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
        } else {
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

        return redirect()->back()->with('success', 'Wali Kelas ' . $user->name . ' Berhasil ditambahkan');
    }

    public function edit(Request $r)
    {
        //DB wali
        wali::where('id_user', $r->id)->update([
            'nuptk' => $r->nuptk,
            'jenis_kelamin' => $r->jenis_kelamin,
            'nip' => $r->nip,
        ]);


        //DB user
        $user = user::where('id', $r->id)->first();

        $user->update([
            'name' => $r->name,
            'email' => $r->email,
            'password' => password_hash($r->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Wali Kelas ' . $user->name . ' Berhasil Diedit');
    }

    public function delete($id)
    {
        $u = user::where('id', $id)->first();
        $n = $u->name;

        wali::where('id_user', $id)->delete();


        $u->delete();

        return redirect()->back()->with('success', 'Wali Kelas ' . $n . ' Berhasil Diedit');
    }

    public function formatWalikelas()
    {
        return Excel::download(new formatWaliKelas, 'formatwalikelas.xlsx');
    }

    public function importWalikelas(Request $r)
    {
        $r->validate([
            'file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new waliSiswaImpor, $r->file('file'));
    }
}
