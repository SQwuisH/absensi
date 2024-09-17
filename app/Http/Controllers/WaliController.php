<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WaliController extends Controller
{
    public function index()
    {
        $user = wali::where('id_user', auth::user()->id)->with('kelas', 'user')->first();
        $kelas = kelas::where('nuptk', $user->nuptk)->first();

        $siswa = siswa::where('id_kelas', $kelas->id_kelas)->get('nis');
        $jumlahsiswa = $siswa->count();

        $a = DB::table('siswas')->join('absensis', 'absensis.nis' , '=', 'siswas.nis')->join('users', 'users.id', '=', 'siswas.id_user')->where('id_kelas', $kelas->id_kelas);
        $absensi = $a->get();
        $harini = $absensi->where('date', date('Y-m-d'));
        $hadir = $harini->wherein('status', ['hadir', 'telambat']);
        $ab = $a->where('absensis.date', date('Y-m-d'))->paginate(10);

        $count = [
            'hadir' => $harini->where('status', 'hadir')->count(),
            'sakit' => $harini->where('status', 'sakit')->count(),
            'izin' => $harini->where('status', 'izin')->count(),
            'terlambat' => $harini->where('status', 'terlambat')->count(),
            'alfa' => $harini->where('status', 'alfa')->count(),
            'TAP' => $harini->where('status', 'TAP')->count()
        ];

        $persentase =  $count['hadir'] > 0 ? round(($count['hadir'] / $jumlahsiswa) * 100) : 0;

        return view('walikelas.index', compact('user', 'kelas', 'siswa', 'absensi', 'harini', 'ab', 'count', 'persentase', 'hadir'));
    }
}
