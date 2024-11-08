<?php

namespace App\Http\Controllers;

use App\Charts\kesiswaanChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\absensi;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\User;
use App\Models\wali;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class KesiswaanController extends Controller
{
    public function index(Request $r)
    {

        $query = kelas::with('jurusan');
        $jurusan = jurusan::all();
        $user = Auth::user();
        $siswa = siswa::all();
        $jumlahsiswa = $siswa->count();
        $kelas = $query->paginate(5);
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->where('date', date('Y-m-d'))->get();
        $count = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'menitTerlambat' => $absensi->sum('menit_terlambat'),
            'menitTAP' => $absensi->sum('menit_TAP'),
        ];

        $list = [
            'hadir' => $absensi->where('status', 'hadir'),
            'sakit' => $absensi->where('status', 'sakit'),
            'izin' => $absensi->where('status', 'izin'),
            'alfa' => $absensi->where('status', 'alfa'),
        ];

        $jur = $r->input('jur');
        $ting = $r->input('ting');

        if ($jur) {
            $kelas = $query->where('id_jurusan', $jur)->paginate(5);
        }
        if ($ting) {
            $kelas = $query->where('tingkat', $ting)->paginate(5);
        }

        $int = 1;
        foreach ($kelas as $k) {
            $class = $k->tingkat . $k->id_jurusan . $k->nomor_kelas;
            $absenkelas[$class] = $absensi->where('id_kelas', $int);
            $siswaKelas[$class] = $siswa->where('id_kelas', $int);

            // GET FILTERED DATA
            $hadir = $absenkelas[$class]->where('status', 'hadir');
            $sakit = $absenkelas[$class]->where('status', 'sakit');
            $izin = $absenkelas[$class]->where('status', 'izin');
            $alfa = $absenkelas[$class]->where('status', 'alfa');

            // GET COUNT OF STATUS
            $counthadir[$class] = $hadir->count();
            $countsakit[$class] = $sakit->count();
            $countizin[$class] = $izin->count();
            $countalfa[$class] = $alfa->count();

            // GET SUM OF TERLAMBAT & TAP
            $menitTerlambat[$class] = $absenkelas[$class]->sum('menit_keterlambatan');
            $menitTAP[$class] = $absenkelas[$class]->sum('menit_TAP');

            $persentase[$class] = [
                "hadir" => $counthadir[$class] > 0 ? round(($counthadir[$class] / $siswaKelas[$class]->count()) * 100) : 0,
            ];

            $int++;
        }

        $persen = [
            'hadir' => $count['hadir'] > 0 ? round(($count['hadir'] / $jumlahsiswa) * 100, 1) : 0,
            'sakit' => $count['sakit'] > 0 ? round(($count['sakit'] / $jumlahsiswa) * 100, 1) : 0,
            'izin' => $count['izin'] > 0 ? round(($count['izin'] / $jumlahsiswa) * 100, 1) : 0,
            'alfa' => $count['alfa'] > 0 ? round(($count['alfa'] / $jumlahsiswa) * 100, 1) : 0,
        ];

        $S = carbon::now()->startOfWeek();
        $start = $S->format('Y-m-d');
        $end = carbon::now()->endOfWeek()->subday(2)->format('Y-m-d');

        // Apply date range filtering
        $query = Absensi::whereBetween('date', [$start, $end])->get();

        $filteredData = $query->groupby('date');

        foreach ($filteredData as $fD) {
            $dailyStatusCounts[] = [
                'hadir' =>  $fD->where('status', 'hadir')->count(),
                'tidakHadir' =>  $fD->wherein('status', ['sakit', 'izin', 'alfa'])->count(),
                'date' => $S->translatedFormat('D, Y-m-d'),
            ];
            $S = $S->addDay();
        }

        $larapexChart = new LarapexChart();
        $chart = (new kesiswaanChart($larapexChart))->build();

        if (carbon::today()->isWeekend()) {
            return view('kesiswaan.indexLibur', compact('user', 'dailyStatusCounts'));
        }

        return view('kesiswaan.index', compact('user', 'absensi', 'count', 'persen', 'persentase', 'jumlahsiswa', 'absenkelas', 'kelas', 'siswaKelas', 'counthadir', 'countsakit', 'countizin', 'countalfa', 'dailyStatusCounts', 'jurusan', 'menitTerlambat', 'menitTAP', 'chart'));
    }

    public function dataHadir()
    {
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->join('users', 'siswas.id_user', '=', 'users.id')->where('status', 'hadir')->where('date', date('Y-m-d'))->get();

        return DataTables::of($absensi)->make(true);
    }

    public function dataSakit()
    {
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->join('users', 'siswas.id_user', '=', 'users.id')->where('status', 'sakit')->where('date', date('Y-m-d'))->get();

        return DataTables::of($absensi)->make(true);
    }

    public function dataIzin()
    {
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->join('users', 'siswas.id_user', '=', 'users.id')->where('status', 'izin')->where('date', date('Y-m-d'))->get();

        return DataTables::of($absensi)->make(true);
    }

    public function dataAlfa()
    {
        $absensi = DB::table('kelas')->join('siswas', 'kelas.id_kelas', '=', 'siswas.id_kelas')->join('absensis', 'siswas.nis', '=', 'absensis.nis')->join('users', 'siswas.id_user', '=', 'users.id')->where('status', 'alfa')->where('date', date('Y-m-d'))->get();

        return DataTables::of($absensi)->make(true);
    }

    public function laporan(Request $r)
    {
        $query = kelas::with('jurusan');
        $jurusan = jurusan::all();
        $user = Auth::user();
        $siswa = siswa::all();
        $jumlahsiswa = $siswa->count();
        $kelas = $query->paginate(5);
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
            'tap' => $absensi->where('status', 'TAP')->count()
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

            $persentase[$class] = [
                'hadir' => $absen[$class]->count() > 0 ? round(($hadir[$class] / $absen[$class]->count()) * 100, 1) : 0,
                'sakit' => $absen[$class]->count() > 0 ? round(($sakit[$class] / $absen[$class]->count()) * 100, 1) : 0,
                'izin' => $absen[$class]->count() > 0 ? round(($izin[$class] / $absen[$class]->count()) * 100, 1) : 0,
                'terlambat' => $absen[$class]->count() > 0 ? round(($terlambat[$class] / $absen[$class]->count()) * 100, 1) : 0,
                'alfa' => $absen[$class]->count() > 0 ? round(($alfa[$class] / $absen[$class]->count()) * 100, 1) : 0,
                'tap' => $absen[$class]->count() > 0 ? round(($TAP[$class] / $absen[$class]->count()) * 100, 1) : 0,
            ];

            $int++;
        }

        $persen = [
            'hadir' => $count['hadir'] > 0 ? round(($count['hadir'] / $absensi->count()) * 100, 1) : 0,
            'sakit' => $count['sakit'] > 0 ? round(($count['sakit'] / $absensi->count()) * 100, 1) : 0,
            'izin' => $count['izin'] > 0 ? round(($count['izin'] / $absensi->count()) * 100, 1) : 0,
            'terlambat' => $count['terlambat'] > 0 ? round(($count['terlambat'] / $absensi->count()) * 100, 1) : 0,
            'alfa' => $count['alfa'] > 0 ? round(($count['alfa'] / $absensi->count()) * 100, 1) : 0,
            'tap' => $count['tap'] > 0 ? round(($count['tap'] / $absensi->count()) * 100, 1) : 0,
        ];

        $jur = $r->input('jur');
        $ting = $r->input('ting');

        if ($jur) {
            $kelas = $query->where('id_jurusan', $jur)->paginate(5);
        }
        if ($ting) {
            $kelas = $query->where('tingkat', $ting)->paginate(5);
        }

        return view('kesiswaan.laporan', compact('user', 'absensi', 'count', 'persen', 'persentase', 'jumlahsiswa', 'absen', 'kelas', 'siswaKelas', 'hadir', 'sakit', 'izin', 'terlambat', 'alfa', 'TAP', 'start', 'end', 'jurusan'));
    }

    public function laporanKelas(Request $r, $kelas)
    {
        $user = Auth::user();
        $k = kelas::where('id_kelas', $kelas)->first();

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
        $ss = siswa::where('id_kelas', $kelas)->with('user');
        $siswa = $ss->get();
        $sw = $ss->paginate(5);

        $search = $r->input('search');

        if ($search) {
            $sw = $ss->wherehas('user', function ($q) use ($search) {
                $q->where('nis', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%');
            })->paginate(5);
        }

        $count = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'terlambat' => $absensi->where('status', 'terlambat')->count(),
            'alfa' => $absensi->where('status', 'alfa')->count(),
            'tap' => $absensi->where('status', 'TAP')->count()
        ];

        foreach ($siswa as $s) {
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


        return view('kesiswaan.laporanKelas', compact('user', 'absensi', 'count', 'persen', 'start', 'end', 'sw', 'k', 'hadir', 'sakit', 'izin', 'terlambat', 'alfa', 'TAP', 'persentase', 'siswa', 'nis', 'kelas'));
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

        $query = absensi::whereBetween('date', [$start, $end])->where('nis', $siswa)->orderBy('date', 'desc');
        $absensi = $query->get();
        $paginated = $query->paginate(10);


        if (isset($r->category) && $r->category != null) {
            $paginated = $query->whereIn('status', $r->category)->paginate(10);
        }

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

        return view('kesiswaan.laporanSiswa', compact('user', 'k', 'sis', 'absensi', 'paginated', 'count', 'persen', 'start', 'end'));
    }

    public function profil()
    {
        $user = wali::where('id_user', auth::user()->id)->with('user')->first();

        return view('kesiswaan.profil', compact('user'));
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
            } else {
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
