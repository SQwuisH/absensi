<?php

namespace App\Http\Controllers;

use App\Exports\formatSiswa;
use App\Imports\siswaImpor;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Contracts\Service\Attribute\Required;

class OperatorSiswa extends Controller
{
    //SISWA
    public function index()
    {
        $siswa = siswa::with('user', 'kelas')->orderby('nis', 'asc')->paginate(15);
        $kelas = kelas::with('jurusan', 'wali')->get();

        return view('operator.siswa.index', compact('siswa', 'kelas'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'Required',
            'kelas' => 'required',
            ]
        );


        if (strlen($request->password) > 0) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'siswa'
            ]);

            siswa::insert([
                'nis' => $request->nis,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_kelas' => $request->kelas,
                'nisn' => $request->nisn,
                'nik_ayah' => $request->nik_ayah ? $request->nik_ayah :null ,
                'nik_ibu' => $request->nik_ibu ? $request->nik_ibu :null,
                'nik_wali' => $request->nik_wali ? $request->nik_wali :null
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'siswa'
            ]);

            $siswa = siswa::insert([
                'nis' => $request->nis,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_kelas' => $request->kelas,
                'nisn' => $request->nisn,
                'nik_ayah' => $request->nik_ayah ? $request->nik_ayah :null ,
                'nik_ibu' => $request->nik_ibu ? $request->nik_ibu :null,
                'nik_wali' => $request->nik_wali ? $request->nik_wali :null
            ]);
        }

        if($user && $siswa)
        {
            return redirect()->back()->with('success', 'berhasil');
        }
        else
        {
            user::where('id', $user->id)->delete();

            return redirect()->back()->with('warning', 'gagal');
        }



    }

    public function delete($id)
    {
        $w = siswa::where('id_user', $id);
        $w->delete();

        $w = User::find($id);
        $w->delete();

        return redirect()->back()->with('success', 'berhasil');
    }

    public function edit(Request $r)
    {
        // DB Siswa
        $siswa = siswa::where('id_user', $r->id)->update([
            'nis' => $r->nis,
            'jenis_kelamin' => $r->jenis_kelamin,
            'nisn' => $r->nisn,
            'id_kelas' => $r->kelas,
            'nik_ayah' => $r->nik_ayah ? $r->nik_ayah : null,
            'nik_ibu' => $r->nik_ibu ? $r->nik_ibu : null,
            'nik_wali' => $r->nik_wali ? $r->nik_wali :null
        ]);


        //DB user
        $user = user::where('id', $r->id)->first();

        $count = strlen($r->password);
        if ($count > 0) {
            $user->update([
                'name' => $r->name,
                'email' => $r->email,
                'password' => password_hash($r->password, PASSWORD_DEFAULT),
            ]);
        }
        else
        {
            $user->update([
                'name' => $r->name,
                'email' => $r->email,
            ]);
        }



        if($user || $siswa)
        {
            return redirect()->back()->with('success', 'Berhasil');
        }
        else
        {
            return redirect()->back()->with('warning', 'Gagal');
        }
    }

    public function importSiswa(Request $r)
    {
        $r->validate([
            'file' => [
                'required',
                'file'
            ],
        ]);

        $cek = Excel::import(new siswaImpor, $r->file('file'));

        if($cek)
        {
            return redirect()->back()->with('success', 'Siswa Berhasil Diimpor');
        }
        else
        {
            return redirect()->back()->with('failed', 'Siswa Gagal Diimpor');
        }
    }

    public function formatSiswa()
    {
        return Excel::download(new formatSiswa, 'formatSiswa.xlsx');
    }
}
