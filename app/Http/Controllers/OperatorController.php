<?php

namespace App\Http\Controllers;

use App\Exports\kelasExpor;
use App\Exports\waliExpor;
use App\Imports\kelasImpor;
use App\Imports\waliImpor;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\koordinat_sekolah;
use App\Models\siswa;
use App\Models\User;
use App\Models\waktu_absen;
use App\Models\wali;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OperatorController extends Controller
{
    public function index()
    {
        return view('operator.index');
    }

    public function wali()
    {
        $walikelas = wali::with('user', 'kelas', 'jurusan')->get();

        return view('operator.wali.wali', compact('walikelas'));
    }

    public function tambahwali(Request $request)
    {
        $user ='';
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

        return redirect()->back()->with('success', 'Wali Kelas '. $user->name . ' Berhasil ditambahkan');
    }

    public function editwali(Request $r)
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

        return redirect()->back()->with('success', 'Wali Kelas '. $user->name . ' Berhasil Diedit');
    }

    public function hapuswali($id)
    {
        $u = user::where('id', $id)->first();
        $n = $u->name;

        wali::where('id_user', $id)->delete();


        $u->delete();

        return redirect()->back()->with('success', 'Wali Kelas '. $n . ' Berhasil Diedit');
    }

    public function kelas()
    {
        $kelas = kelas::with('wali', 'user', 'jurusan')->get();

        $jurusan = jurusan::get();

        $nuptk = db::table('kelas')->select('nuptk')->where('nuptk', '!=', 'null')->get();
        $kosong = wali::with('user', 'kelas', 'jurusan')->whereNotIn('nuptk', json_decode(json_encode($nuptk), true))->get();

        return view('operator.kelas.kelas', compact('kelas', 'kosong', 'jurusan'));
    }

    public function siswa($id)
    {
        $siswa = siswa::with('user', 'kelas')->where('id_kelas', '=', $id)->get();

        $kelas = kelas::with('jurusan')->get();

        return view('operator.kelas.kelassiswa', compact('siswa', 'kelas', 'id'));
    }

    public function tambahsiswa(Request $request)
    {
        if(strlen($request->password) > 0)
        {
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'siswa'
            ]);

            siswa::insert([
                'nis' => $request->nis,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_kelas' => $request->id_kelas,
                'nisn' => $request->nisn,
            ]);
        }
        else
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'siswa'
            ]);

            siswa::insert([
                'nis' => $request->nis,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_kelas' => $request->id_kelas,
                'nisn' => $request->nisn,
            ]);
        }

        return redirect()->back();
    }

    public function hapussiswa($id)
    {
        $w = siswa::where('id_user',$id);
        $w->delete();

        $w = user::find($id);
        $w->delete();

        return redirect()->back();
    }

    public function tambahkelas(Request $r)
    {
        kelas::insert([
            'id_jurusan' => $r->id_jurusan,
            'nuptk' => $r->nuptk,
            'nomor_kelas' => $r->nomor_kelas,
            'tingkat' => $r->tingkat
        ]);

        return redirect()->back();
    }

    public function editkelas(request $r)
    {
        db::table('kelas')->where('id_kelas', $r->id)->update([
            'id_jurusan' => $r->id_jurusan,
            'nuptk' => $r->nuptk,
            'nomor_kelas' => $r->nomor_kelas,
            'tingkat' => $r->tingkat
        ]);

        return redirect()->back();
    }

    public function hapuskelas($id)
    {
        $w = kelas::find($id);
        $w->delete();

        return redirect()->back();
    }

    public function koordinat()
    {
        $koordinat = DB::table('koordinat_sekolahs')->first();

        return view('operator.koordinat', compact('koordinat'));
    }

    public function editkoordinat(Request $r)
    {
        db::table('koordinat_sekolahs')->update([
            'titik_koordinat' => $r->k,
            'radius' => $r->r
        ]);

        return redirect()->back();
    }

    public function waktu()
    {
        $waktu = waktu_absen::first();

        return view('operator.absen', compact('waktu'));
    }

    public function editwaktu(Request $r)
    {
        db::table('waktu_absens')->update([
            'mulai_absen' => $r->mulai_absen,
            'batas_absen' => $r->batas_absen,
            'mulai_pulang' => $r->mulai_pulang,
            'batas_pulang' => $r->batas_pulang
        ]);

        return redirect()->back();
    }

    public function jurusan()
    {
        $jurusan = jurusan::all();
        return view('operator.jurusan.jurusan', compact('jurusan'));
    }

    public function tambahjurusan(Request $j)
    {
        $jur = jurusan::insert(['id_jurusan' => $j->id_jurusan,'nama_jurusan' => $j->nama_jurusan]);

        return redirect()->back()->with('success', 'Jurusan '. $jur->id_jurusan . ' Berhasil ditambahkan');
    }

    public function editjurusan(Request $j)
    {
        $jur = jurusan::where('id_jurusan', $j->id)->first();
        $jur->update(['id_jurusan' => $j->id_jurusan, 'nama_jurusan' => $j->nama_jurusan]);

        return redirect()->back()->with('success', 'Jurusan '. $jur->id_jurusan . ' Berhasil Diedit');
    }

    public function hapusjurusan($id)
    {
        $jur = jurusan::where('id_jurusan', $id)->first();
        $j = $jur->id_jurusan;
        $jur->delete();

        return redirect()->back()->with('success', 'Jurusan '. $j .' Berhasil Dihapus');
    }

    public function kesiswaan()
    {
        $kesiswaan = user::where('role', '=', 'kesiswaan')->get();

        return view('operator.kesiswaan.kesiswaan', compact('kesiswaan'));
    }

    public function tambahkesiswaan(Request $r)
    {
        if (strlen($r->password) > 0) {
            user::create([
                'name' => $r->name,
                'email' => $r->email,
                'password' => password_hash($r->password, PASSWORD_DEFAULT),
                'role' => 'kesiswaan'
            ]);
        }
        else
        {
            user::create([
                'name' => $r->name,
                'email' => $r->email,
                'role' => 'kesiswaan'
            ]);
        }

        return redirect()->back();
    }

    public function editkesiswaan(Request $r)
    {
        if (strlen($r->password) > 0)
        {
            user::find($r->id)->update([
                'name' => $r->name,
                'email' => $r->email,
                'password' => password_hash($r->password, PASSWORD_DEFAULT),
            ]);
        }
        else
        {
            user::find($r->id)->update([
                'name' => $r->name,
                'email' => $r->email,
            ]);
        }

        return redirect()->back();
    }

    public function hapuskesiswaan($id)
    {
        User::find($id)->delete();

        return redirect()->back();
    }

    public function exportWali()
    {
        return Excel::download(new waliExpor, 'formatwali.xlsx');
    }

    public function importWali(Request $r)
    {
        $r->validate([
            'file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new waliImpor, $r->file('file'));

    }

    public function exportkelas()
    {
        return Excel::download(new kelasExpor, 'formatkelas.xlsx');
    }

    public function importkelas(Request $r)
    {
        $r->validate([
            'file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new kelasImpor, $r->file('file'));

        return redirect()->back()->with('success', 'Kelas Berhasil Diimpor');
    }
}
