<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\User;
use App\Models\wali;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;
use Illuminate\Support\Facades\Storage;

class WaliController extends Controller
{
    public function index()
    {
        $dailyStatusCounts = [];
        $user = wali::where('id_user', auth::user()->id)->with('kelas', 'user')->first();
        $kelas = kelas::where('nip', $user->nip)->first();

        $siswa = siswa::where('id_kelas', $kelas->id_kelas)->get('nis');
        $jumlahsiswa = $siswa->count();

        $a = DB::table('siswas')->join('absensis', 'absensis.nis' , '=', 'siswas.nis')->join('users', 'users.id', '=', 'siswas.id_user')->where('id_kelas', $kelas->id_kelas);
        $absensi = $a->get();
        $harini = $absensi->where('date', date('Y-m-d'));
        $ab = $a->where('absensis.date', date('Y-m-d'))->paginate(10);

        $count = [
            'hadir' => $harini->where('status', 'hadir')->count(),
            'sakit' => $harini->where('status', 'sakit')->count(),
            'izin' => $harini->where('status', 'izin')->count(),
            'terlambat' => $harini->where('status', 'terlambat')->count(),
            'alfa' => $harini->where('status', 'alfa')->count(),
            'tap' => $harini->where('status', 'TAP')->count()
        ];

        $persentase = [
            'hadir' => $harini->count() > 0 ? round(($count['hadir'] / $harini->count()) * 100, 1) : 0,
            'sakit' => $harini->count() > 0 ? round(($count['sakit'] / $harini->count()) * 100, 1) : 0,
            'izin' => $harini->count() > 0 ? round(($count['izin'] / $harini->count()) * 100, 1) : 0,
            'terlambat' => $harini->count() > 0 ? round(($count['terlambat'] / $harini->count()) * 100, 1) : 0,
            'alfa' => $harini->count() > 0 ? round(($count['alfa'] / $harini->count()) * 100, 1) : 0,
            'tap' => $harini->count() > 0 ? round(($count['tap'] / $harini->count()) * 100, 1) : 0,
        ];

        $S = Carbon::now()->startOfWeek();
        $start = $S->format('Y-m-d');
        $end = Carbon::now()->endOfWeek()->subday(2)->format('Y-m-d');

        // Apply date range filtering
        $query = $absensi->whereBetween('date', [$start, $end]);

        $filteredData = $query->groupby('date');

        foreach ($filteredData as $fD) {
            $dailyStatusCounts[] = [
                'hadir' =>  $fD->wherein('status', ['hadir', 'terlambat'])->count(),
                'tidakHadir' =>  $fD->wherein('status', ['sakit', 'izin', 'alfa', 'TAP'])->count(),
                'date' => $S->translatedFormat('D, Y-m-d'),
            ];
            $S = $S->addDay();
        }

        return view('walikelas.index', compact('user', 'kelas', 'siswa', 'absensi', 'harini', 'ab', 'count', 'persentase', 'dailyStatusCounts'));
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
            'tap' => $absensi->where('status', 'TAP')->count()
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

            $persentase[$nis] = [
                'hadir' => $absen[$nis]->count() > 0 ? round(($hadir[$nis] / $absen[$nis]->count()) * 100, 1) : 0,
                'sakit' => $absen[$nis]->count() > 0 ? round(($sakit[$nis] / $absen[$nis]->count()) * 100, 1) : 0,
                'izin' => $absen[$nis]->count() > 0 ? round(($izin[$nis] / $absen[$nis]->count()) * 100, 1) : 0,
                'terlambat' => $absen[$nis]->count() > 0 ? round(($terlambat[$nis] / $absen[$nis]->count()) * 100, 1) : 0,
                'alfa' => $absen[$nis]->count() > 0 ? round(($alfa[$nis] / $absen[$nis]->count()) * 100, 1) : 0,
                'tap' => $absen[$nis]->count() > 0 ? round(($TAP[$nis] / $absen[$nis]->count()) * 100, 1) : 0,
            ];
        }

        $persen = [
            'hadir' => $count['hadir'] > 0 ? round(($count['hadir'] / $absensi->count()) * 100, 1) : 0,
            'sakit' => $count['sakit'] > 0 ? round(($count['sakit'] / $absensi->count()) * 100, 1) : 0,
            'izin' => $count['izin'] > 0 ? round(($count['izin'] / $absensi->count()) * 100, 1) : 0,
            'terlambat' => $count['terlambat'] > 0 ? round(($count['terlambat'] / $absensi->count()) * 100, 1) : 0,
            'alfa' => $count['alfa'] > 0 ? round(($count['alfa'] / $absensi->count()) * 100, 1) : 0,
            'tap' => $count['tap'] > 0 ? round(($count['tap'] / $absensi->count()) * 100, 1) : 0,
        ];

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
        $paginated = $ab->paginate(10);

        $count = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'terlambat' => $absensi->where('status', 'terlambat')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'tap' => $absensi->where('status', 'TAP')->count()
        ];

        $persen = [
            'hadir' => $count['hadir'] > 0 ? round(($count['hadir'] / $absensi->count()) * 100, 1) : 0,
            'sakit' => $count['sakit'] > 0 ? round(($count['sakit'] / $absensi->count()) * 100, 1) : 0,
            'izin' => $count['izin'] > 0 ? round(($count['izin'] / $absensi->count()) * 100, 1) : 0,
            'terlambat' => $count['terlambat'] > 0 ? round(($count['terlambat'] / $absensi->count()) * 100, 1) : 0,
            'alfa' => $count['alfa'] > 0 ? round(($count['alfa'] / $absensi->count()) * 100, 1) : 0,
            'tap' => $count['tap'] > 0 ? round(($count['tap'] / $absensi->count()) * 100, 1) : 0,
        ];

        return view('walikelas.laporanSiswa', compact('user', 'k', 'sis', 'absensi', 'paginated' , 'count', 'persen', 'start', 'end'));
    }

    public function profil()
    {
        $user = wali::where('id_user', Auth::user()->id)->with('user')->first();

        return view('walikelas.profil', compact('user'));
    }

    public function editProfil(request $r)
    {
        $f = false;
        $p = false;

        //password
        $count = strlen($r->password);
        if ($count > 0) {
            if ($r->password != $r->kPassword) {
                return redirect()->back()->with('failed', 'Password Berbeda');
            }
            else
            {
                $p = User::where('id', $r->id)->update([
                    'password' => password_hash($r->password, PASSWORD_DEFAULT)
                ]);
            }
        }


        //foto
        if ($r->hasFile('foto')) {
            $foto = $r->file('foto');

            $folderPath = "public/user_avatar/";

            $extension = $foto->getClientOriginalExtension();
            $fileName = $r->nis . '.' . $extension;
            $file = $folderPath . $fileName;

            Storage::put($file, file_get_contents($foto));

            $f = User::where('id', $r->id)->update([
                'foto' => $fileName
            ]);
        }

        // email
        $u = User::where('id', $r->id)->update([
            'email' => $r->email,
        ]);

        //alamat


        //redirecting
        if ($u || $f || $p) {
            return redirect()->back()->with('success', "Data Berhasil di Update");
        } else {
            return redirect()->back()->with('failed', "Data Gagal di Update");
        }
    }
}
