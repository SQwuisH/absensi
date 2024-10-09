<?php

namespace App\Http\Controllers;

use App\Exports\kelasExpor;
use App\Exports\waliExpor;
use App\Imports\siswaImpor;
use App\Imports\waliImpor;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\koordinat_sekolah;
use App\Models\siswa;
use App\Models\User;
use App\Models\waktu_absen;
use App\Models\wali;
use App\Models\wali_siswa;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OperatorController extends Controller
{
    //PRESENSI
    public function index()
    {
        $koordinat = DB::table('koordinat_sekolahs')->first();
        $waktu = waktu_absen::first();

        return view('operator.index', compact('koordinat', 'waktu'));
    }

    public function editkoordinat(Request $r)
    {
        db::table('koordinat_sekolahs')->update([
            'titik_koordinat' => $r->k,
            'radius' => $r->r
        ]);

        return redirect()->back();
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

    //KELAS
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
        $k = kelas::with('jurusan')->where('id_kelas', $id)->first();
        $kelas = kelas::with('jurusan')->get();

        return view('operator.kelas.kelassiswa', compact('siswa', 'kelas', 'id', 'k'));
    }

    public function addkelas(Request $r)
    {
        kelas::insert([
            'id_jurusan' => $r->id_jurusan,
            'nuptk' => $r->nuptk,
            'nomor_kelas' => $r->nomor_kelas,
            'tingkat' => $r->tingkat
        ]);

        $k = kelas::where('id_kelas', $r->id)->first();

        $kelas = strtoupper("$k->tingkat $k->id_jurusan $k->nomor_kelas");

        return redirect()->back()->with('success', 'kelas ' . $kelas . ' Berhasil ditambahkan');;
    }

    public function editkelas(request $r)
    {
        db::table('kelas')->where('id_kelas', $r->id)->update([
            'id_jurusan' => $r->id_jurusan,
            'nuptk' => $r->nuptk,
            'nomor_kelas' => $r->nomor_kelas,
            'tingkat' => $r->tingkat
        ]);

        $k = kelas::where('id_kelas', $r->id)->first();

        $kelas = strtoupper("$k->tingkat $k->id_jurusan $k->nomor_kelas");

        return redirect()->back()->with('success', 'kelas ' . $kelas . ' Berhasil Edit');
    }

    public function deletekelas($id)
    {
        $k = kelas::find($id);
        $kelas = strtoupper("$k->tingkat $k->id_jurusan $k->nomor_kelas");
        $k->delete();

        return redirect()->back()->with('success', 'kelas ' . $kelas . ' Berhasil Dihapus');
    }

    //JURUSAN
    public function jurusan()
    {
        $jurusan = jurusan::paginate(7);
        return view('operator.jurusan.jurusan', compact('jurusan'));
    }

    public function addjurusan(Request $j)
    {
        $jur = jurusan::insert(['id_jurusan' => $j->id_jurusan, 'nama_jurusan' => $j->nama_jurusan]);

        return redirect()->back()->with('success', 'Jurusan ' . $j->id_jurusan . ' Berhasil ditambahkan');
    }

    public function editjurusan(Request $j)
    {
        $jur = jurusan::where('id_jurusan', $j->id)->first();
        $jur->update(['id_jurusan' => $j->id_jurusan, 'nama_jurusan' => $j->nama_jurusan]);

        return redirect()->back()->with('success', 'Jurusan ' . $j->id_jurusan . ' Berhasil Diedit');
    }

    public function deletejurusan($id)
    {
        $jur = jurusan::where('id_jurusan', $id)->first();
        $j = $jur->id_jurusan;
        $jur->delete();

        return redirect()->back()->with('success', 'Jurusan ' . $j . ' Berhasil Dihapus');
    }

    // Kesiswaan
    public function kesiswaan()
    {
        $kesiswaan = user::where('role', '=', 'kesiswaan')->get();

        return view('operator.kesiswaan.kesiswaan', compact('kesiswaan'));
    }

    public function addkesiswaan(Request $r)
    {
        if (strlen($r->password) > 0) {
            user::create([
                'name' => $r->name,
                'email' => $r->email,
                'password' => password_hash($r->password, PASSWORD_DEFAULT),
                'role' => 'kesiswaan'
            ]);
        } else {
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
        if (strlen($r->password) > 0) {
            user::find($r->id)->update([
                'name' => $r->name,
                'email' => $r->email,
                'password' => password_hash($r->password, PASSWORD_DEFAULT),
            ]);
        } else {
            user::find($r->id)->update([
                'name' => $r->name,
                'email' => $r->email,
            ]);
        }

        return redirect()->back();
    }

    public function deletekesiswaan($id)
    {
        User::find($id)->delete();

        return redirect()->back();
    }
}
