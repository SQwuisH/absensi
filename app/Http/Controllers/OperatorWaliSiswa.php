<?php

namespace App\Http\Controllers;

use App\Exports\formatWaliSiswa;
use App\Models\User;
use App\Models\wali_siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OperatorWaliSiswa extends Controller
{
    //WALI SISWA
    public function index()
    {
        $walisiswa =  wali_siswa::with('user')->get();

        return view('operator.walisiswa.index', compact('walisiswa'));
    }

    public function add(request $r)
    {
        if(strlen($r->password) > 0)
        {
            $u = User::create([
                'name' => $r->name,
                'password' => password_hash($r->password, 'default_password'),
                'email' => $r->email,
                'role' => 'wali siswa'
            ]);
        }
        else
        {
            $u = User::create([
                'name' => $r->name,
                'email' => $r->email,
                'role' => 'wali siswa'
            ]);
        }


        $w = wali_siswa::insert([
            'nik' => $r->nik,
            'id_user' => $u->id,
            'jenis_kelamin' => $r->jenis_kelamin
        ]);

        if ($u && $w)
        {
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('warning', 'Gagal Menambahkan Data');
        }
    }

    public function edit(Request $r)
    {
        //DB wali
        wali_siswa::where('id_user', $r->id)->update([
            'nik' => $r->nik,
            'jenis_kelamin' => $r->jenis_kelamin,
        ]);


        //DB user
        $user = user::where('id', $r->id)->first();

        $user->update([
            'name' => $r->name,
            'email' => $r->email,
            'password' => password_hash($r->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Wali Siswa ' . $user->name . ' Berhasil Diedit');
    }

    public function delete($id)
    {
        $u = user::where('id', $id)->first();
        $n = $u->name;

        wali_siswa::where('id_user', $id)->delete();
        $u->delete();

        return redirect()->back()->with('success', 'Wali Siswa ' . $n . ' Berhasil Dihapus');
    }

    public function imporwalisiswa(Request $r)
    {
        $r->validate([
            'file' => ['required' , 'file'],
        ]);


    }

    public function formatwalisiswa()
    {
        return Excel::download(new formatWaliSiswa, 'formatwalisiswa.xlsx');
    }
}
