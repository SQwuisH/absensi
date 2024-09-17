<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\wali;
use App\Models\wali_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KesiswaanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $siswa = siswa::all();
        $jumlahsiswa = $siswa->count();
        $kelas = kelas::all();
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->where('date', date('Y-m-d'))->get();
        $count = [
            'datang' => $absensi->where('status', ['hadir', 'terlambat'])->count(),
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'terlambat' => $absensi->where('status', 'terlambat')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'TAP' => $absensi->where('status', 'TAP')->count()
        ];

        $int = 1;
        foreach ($kelas as $k) {
            $nama = $k->tingkat . $k->id_jurusan . $k->nomor_kelas;
            $absenkelas[$nama] = $absensi->where('id_kelas', $int);
            $siswaKelas[$nama] = $siswa->where('id_kelas', $int);
            $persentase[$nama] = $absenkelas[$nama]->count() > 0 ? round(($absenkelas[$nama]->count() / $siswaKelas[$nama]->count()) * 100) : 0;
            $int++;
        }

        $persen =  $count['hadir'] > 0 ? round(($count['hadir'] / $jumlahsiswa) * 100) : 0;

        return view('kesiswaan.index', compact('user', 'absensi', 'count', 'persen','persentase', 'jumlahsiswa', 'absenkelas', 'kelas','siswaKelas'));
    }
}
