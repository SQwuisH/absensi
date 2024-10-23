<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;


class WaliController extends Controller
{
    public function index()
    {
        $user = wali::where('id_user', auth::user()->id)->with('kelas', 'user')->first();
        $kelas = kelas::where('nip', $user->nip)->first();

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

    public function laporan(Request $r)
    {
        $user = wali::where('id_user', Auth::user()->id)->with('kelas')->first();
        $k = kelas::where('nip', $user->nip)->first();

        // Date
        $a = absensi::orderBy('date', 'asc')->get('date')->first();
        $start = $a->date;
        $end = date("Y-m-d");
        if (isset($r->daterange)) {
            $date = Str::of($r->daterange)->remove('-')->replace('/', '-')->split('/[\s,]+/');
            $start = DateTime::createFromFormat("m-d-Y", $date[0])->format("Y-m-d");
            $end = DateTime::createFromFormat("m-d-Y", $date[1])->format("Y-m-d");
        }

        $ab = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->join('users', 'users.id', '=', 'siswas.id_user')->whereBetween('date', [$start, $end])->where('kelas.id_kelas', $k->id_kelas);
        $absensi = $ab->get();
        $ss = siswa::where('id_kelas', $k->id_kelas)->with('user');
        $siswa = $ss->get();
        $paginated = $ss->paginate(5);

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

        return view('walikelas.laporan', compact('user', 'absensi', 'count', 'persen', 'start', 'end', 'paginated', 'k', 'hadir', 'sakit', 'izin', 'terlambat', 'alfa', 'TAP', 'persentase' , 'siswa'));
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

        return view('walikelas.laporanSiswa', compact('user', 'k', 'sis', 'absensi', 'paginated' , 'count', 'persen', 'start', 'end'));
    }
}
