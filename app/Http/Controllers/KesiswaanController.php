<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\wali;
use App\Models\wali_siswa;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KesiswaanController extends Controller
{
    public function index(Request $r)
    {
        $user = Auth::user();
        $siswa = siswa::all();
        $jumlahsiswa = $siswa->count();
        $kelas = kelas::all();
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->where('date', date('Y-m-d'))->get();
        $count = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'terlambat' => $absensi->where('status', 'terlambat')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'TAP' => $absensi->where('status', 'TAP')->count()
        ];

        $int = 1;
        foreach ($kelas as $k) {
            $class = $k->tingkat . $k->id_jurusan . $k->nomor_kelas;
            $absenkelas[$class] = $absensi->where('id_kelas', $int);
            $siswaKelas[$class] = $siswa->where('id_kelas', $int);
            $hadir[$class] = $absenkelas[$class]->where('status', 'hadir')->count();
            $sakit[$class] = $absenkelas[$class]->where('status', 'sakit')->count();
            $izin[$class] = $absenkelas[$class]->where('status', 'izin')->count();
            $terlambat[$class] = $absenkelas[$class]->where('status', 'terlambat')->count();
            $alfa[$class] = $absenkelas[$class]->where('status', 'alfa')->count();
            $TAP[$class] = $absenkelas[$class]->where('status', 'TAP')->count();
            $persentase[$class] = [
                "hadir" => $hadir[$class] > 0 ? round(($hadir[$class] / $siswaKelas[$class]->count()) * 100) : 0,
                "terlambat" => $terlambat[$class] > 0 ? round(($terlambat[$class] / $siswaKelas[$class]->count()) * 100) : 0
            ];

            $int++;
        }

        $persen =  [
            "hadir" => $count['hadir'] > 0 ? round(($count['hadir'] / $jumlahsiswa) * 100) : 0,
            "terlambat" => $count['terlambat'] > 0 ? round(($count['terlambat'] / $jumlahsiswa) * 100) : 0
        ];

        return view('kesiswaan.index', compact('user', 'absensi', 'count', 'persen', 'persentase', 'jumlahsiswa', 'absenkelas', 'kelas', 'siswaKelas', 'hadir', 'sakit', 'izin', 'terlambat', 'alfa', 'TAP'));
    }

    public function laporan(Request $r)
    {
        $user = Auth::user();
        $siswa = siswa::all();
        $jumlahsiswa = $siswa->count();
        $kelas = kelas::all();
        $s = absensi::orderBy('date', 'asc')->get('date')->first();
        $start = $s->date;
        $end = date("Y-m-d");
        if (isset($r->daterange)) {
            $array = Str::of($r->daterange)->remove('-')->replace('/', '-')->split('/[\s,]+/');
            $start = DateTime::createFromFormat("m-d-Y", $array[0])->format("Y-m-d");
            $end = DateTime::createFromFormat("m-d-Y", $array[1])->format("Y-m-d");
        }
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->whereBetween('date', [$start, $end])->get();
        $count = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'terlambat' => $absensi->where('status', 'terlambat')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'TAP' => $absensi->where('status', 'TAP')->count()
        ];

        $int = 1;
        foreach ($kelas as $k) {
            $class = $k->tingkat . $k->id_jurusan . $k->nomor_kelas;
            $absen[$class] = $absensi->where('id_kelas', $int);
            $siswaKelas[$class] = $siswa->where('id_kelas', $int);
            $hadir[$class] = $absen[$class]->where('status', 'hadir')->count();
            $sakit[$class] = $absen[$class]->where('status', 'sakit')->count();
            $izin[$class] = $absen[$class]->where('status', 'izin')->count();
            $terlambat[$class] = $absen[$class]->where('status', 'terlambat')->count();
            $alfa[$class] = $absen[$class]->where('status', 'alfa')->count();
            $TAP[$class] = $absen[$class]->where('status', 'TAP')->count();

            $persentase[$class] = $hadir[$class] > 0 ? round(($hadir[$class] / $absen[$class]->count()) * 100) : 0;

            $int++;
        }

        $persen = $count['hadir'] > 0 ? round(($count['hadir'] / $absensi->count()) * 100) : 0;

        return view('kesiswaan.laporan', compact('user', 'absensi', 'count', 'persen', 'persentase', 'jumlahsiswa', 'absen', 'kelas', 'siswaKelas', 'hadir', 'sakit', 'izin', 'terlambat', 'alfa', 'TAP', 'start' , 'end'));
    }

    public function laporanKelas(Request $r, $kelas)
    {
        $user = Auth::user();
        $k = kelas::where('id_kelas',$kelas)->first();

        // Date
        $a = absensi::orderBy('date', 'asc')->get('date')->first();
        $start = $a->date;
        $end = date("Y-m-d");
        if (isset($r->daterange)) {
            $date = Str::of($r->daterange)->remove('-')->replace('/', '-')->split('/[\s,]+/');
            $start = DateTime::createFromFormat("m-d-Y", $date[0])->format("Y-m-d");
            $end = DateTime::createFromFormat("m-d-Y", $date[1])->format("Y-m-d");
        }

        $ab = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->join('users', 'users.id', '=', 'siswas.id_user')->whereBetween('date', [$start, $end])->where('kelas.id_kelas', $kelas);
        $absensi = $ab->get();
        $siswa = siswa::where('id_kelas', $kelas)->with('user')->get();
        $sw = $ab->paginate(5);

        $count = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'terlambat' => $absensi->where('status', 'terlambat')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'TAP' => $absensi->where('status', 'TAP')->count()
        ];

        foreach ($siswa as $s)
        {
            $nis = "00$s->nis";

            $absen[$nis] = $absensi->where('nis', $nis);
            $hadir[$nis] = $absen[$nis]->where('status', 'hadir')->count();
            $sakit[$nis] = $absen[$nis]->where('status', 'sakit')->count();
            $izin[$nis] = $absen[$nis]->where('status', 'izin')->count();
            $terlambat[$nis] = $absen[$nis]->where('status', 'terlambat')->count();
            $alfa[$nis] = $absen[$nis]->where('status', 'alfa')->count();
            $TAP[$nis] = $absen[$nis]->where('status', 'TAP')->count();

            $persentase[$nis] = $hadir[$nis] > 0 ? round(($hadir[$nis] / $absen[$nis]->count()) * 100) : 0;

        }

        $persen = $count['hadir'] > 0 ? round(($count['hadir'] / $absensi->count()) * 100) : 0;

        return view('kesiswaan.laporanKelas', compact('user', 'absensi', 'count', 'persen', 'start', 'end', 'sw', 'k', 'hadir', 'sakit', 'izin', 'terlambat', 'alfa', 'TAP', 'persentase' , 'siswa', 'nis'));
    }

    public function laporanSiswa(Request $r, $siswa)
    {
        $user = Auth::user();
        $sis = siswa::where('nis', $siswa)->with('user')->first();

        $k = kelas::where('id_kelas', $sis->id_kelas)->first();

        $a = absensi::orderBy('date', 'asc')->get('date')->first();
        $start = $a->date;
        $end = date("Y-m-d");
        if (isset($r->daterange)) {
            $date = Str::of($r->daterange)->remove('-')->replace('/', '-')->split('/[\s,]+/');
            $start = DateTime::createFromFormat("m-d-Y", $date[0])->format("Y-m-d");
            $end = DateTime::createFromFormat("m-d-Y", $date[1])->format("Y-m-d");
        }

        $ab = absensi::whereBetween('date', [$start, $end])->where('nis', $siswa);
        $absensi = $ab->get();
        $paginated = $ab->paginate(5);

        $count = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'terlambat' => $absensi->where('status', 'terlambat')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'TAP' => $absensi->where('status', 'TAP')->count()
        ];

        $persen = $count['hadir'] > 0 ? round(($count['hadir'] / $absensi->count()) * 100) : 0;

        return view('kesiswaan.laporanSiswa', compact('user', 'k', 'sis', 'absensi', 'paginated' , 'count', 'persen', 'start', 'end'));
    }
}
