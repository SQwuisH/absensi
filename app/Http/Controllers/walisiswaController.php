<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\siswa;
use App\Models\User;
use App\Models\waktu_absen;
use App\Models\wali_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DateTime;

class walisiswaController extends Controller
{
    public function index()
    {
        $walisiswa = wali_siswa::where('id_user', Auth::user()->id)->with('user')->first();
        $waktu = waktu_absen::first();

        if ($walisiswa->jenis_kelamin == "laki laki") {
            $first = siswa::with('user', 'kelas')->where('nik_ayah', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->first();
            $siswa = siswa::with('user', 'kelas')->where('nik_ayah', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->get();
        } elseif ($walisiswa->jenis_kelamin == "perempuan") {
            $first = siswa::with('user', 'kelas')->where('nik_ibu', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->first();
            $siswa = siswa::with('user', 'kelas')->where('nik_ibu', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->get();
        }

        $int = 0;
        foreach ($siswa as $s) {
            $nama[] = strtoLower($s["user"]["name"]);
            $semua = absensi::where('nis', $s["nis"])->get();
            // CEK ABSENSI
            $cekabsen = absensi::with('absensi')->where('date', date('Y-m-d'))->where('nis', $s["nis"])->first();
            if ($cekabsen) {
                if (date("H:i:s") < $waktu->mulai_absen) {
                    $statusAbsen[] = "belum waktu presen";
                } elseif ($cekabsen->status == "alfa" && date("H:i:s") < $waktu->mulai_pulang) {
                    $statusAbsen[] = "belum presen";
                } elseif (($cekabsen->status == 'hadir' || $cekabsen->status == 'terlambat') && date("H:i:s") > $waktu->mulai_pulang) {
                    $statusAbsen[] = "belum pulang";
                } elseif ($cekabsen->foto_pulang) {
                    $statusAbsen[] = "sudah pulang";
                } else {
                    $statusAbsen[] = $cekabsen->status;
                }
            } else {
                $statusAbsen[] = "libur";
            }
            $ini = absensi::whereYear('date', date('Y'))
                ->where('nis', $s["nis"])
                ->whereMonth('date', date('m'))->get();
            $lalu = absensi::whereYear('date', date('Y'))
                ->where('nis', $s["nis"])
                ->whereMonth('date', date('m', strtotime('first day of previous month')))->get();


            $jumlah[] = [
                // SEMUA
                'semua' => $semua->count(),
                'hadirSemua' => $semua->whereIn('status', ["hadir", "terlambat", "TAP"])->count(),
                'tidakHadirSemua' => $semua->whereIn('status', ["sakit", "izin", "alfa"])->count(),

                // BULAN INI
                'ini' => $ini->count(),
                'hadirIni' => $ini->whereIn('status', ["hadir", "terlambat", "TAP"])->count(),
                'tidakHadirIni' => $ini->whereIn('status', ["sakit", "izin", "alfa"])->count(),

                // BULAN LALU
                'lalu' => $lalu->count(),
                'hadirLalu' => $lalu->whereIn('status', "hadir")->count(),
                'tidakHadirLalu' => $lalu->whereIn('status', "sakit")->count(),
            ];
            $persentase[] = [
                'semua' => $jumlah["$int"]['hadirSemua'] > 0 ? round(($jumlah["$int"]['hadirSemua'] / $jumlah["$int"]['semua']) * 100, 1) : 0,
                'ini' => $jumlah["$int"]['hadirIni'] > 0 ? round(($jumlah["$int"]['hadirIni'] / $jumlah["$int"]['ini']) * 100, 1) : 0,
                'lalu' => $jumlah["$int"]['hadirLalu'] > 0 ? round(($jumlah["$int"]['hadirLalu'] / $jumlah["$int"]['lalu']) * 100, 1) : 0
            ];

            $int = $int + 1;
        }


        return view('walisiswa.index', compact('walisiswa', 'siswa', 'ini', 'lalu', 'jumlah', 'persentase', 'first', 'statusAbsen'));
    }

    public function profil()
    {
        $walisiswa = wali_siswa::where('id_user', Auth::user()->id)->with('user')->first();
        if ($walisiswa->jenis_kelamin == "laki laki") {
            $siswa = siswa::with('user', 'kelas')->where('nik_ayah', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->first();
        } elseif ($walisiswa->jenis_kelamin == "perempuan") {
            $siswa = siswa::with('user', 'kelas')->where('nik_ibu', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->first();
        }

        return view('walisiswa.profil', compact('walisiswa', 'siswa'));
    }

    public function editprofil(request $r)
    {
        $f = false;
        $P = false;

        //password
        $count = strlen($r->password);
        if ($count > 0) {
            $p = User::where('id', $r->id)->update([
                'password' => password_hash($r->password, PASSWORD_DEFAULT)
            ]);
        }
        if ($r->password != $r->kPassword) {
            return redirect()->back()->with('failed', 'Password Berbeda');
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

        //redirecting
        if ($u || $f || $p) {
            return redirect()->back()->with('success', "Data Berhasil di Update");
        } else {
            return redirect()->back()->with('failed', "Data Gagal di Update");
        }
    }

    public function laporan(Request $request, $nis)
    {
        $walisiswa = wali_siswa::where('id_user', Auth::user()->id)->with('user')->first();
        if ($walisiswa->jenis_kelamin == "laki laki") {
            $siswa = siswa::with('user', 'kelas')->where('nik_ayah', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->first();
            $allSiswa = siswa::with('user', 'kelas')->where('nik_ayah', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->get();
        } elseif ($walisiswa->jenis_kelamin == "perempuan") {
            $siswa = siswa::with('user', 'kelas')->where('nik_ibu', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->first();
            $allSiswa = siswa::with('user', 'kelas')->where('nik_ibu', '=', $walisiswa->nik)->orwhere('nik_wali', '=', $walisiswa->nik)->get();
        }
        $nis = $siswa->nis;
        $query = absensi::query()->orderBy('date', 'desc')->where('nis', '00' . $nis);

        $abs = absensi::orderBy('date', 'asc')->where('nis', '00' . $nis)->first();

        $start = $abs->date;
        $end = date("Y-m-d");

        if (isset($request->daterange) || $request->daterange != null) {
            $date = Str::of($request->daterange)->remove('-')->replace('/', '-')->split('/[\s,]+/');
            $start = DateTime::createFromFormat("m-d-Y", $date[0])->format("Y-m-d");
            $end = DateTime::createFromFormat("m-d-Y", $date[1])->format("Y-m-d");
        }
        if (isset($request->category) || $request->category != null) {
            $query->whereIn('status', $request->category);
        }
        $absensi = $query->whereBetween('date', [$start, $end])->paginate(15);
        $ab = absensi::where('nis', $siswa->nis)->whereBetween('date', [$start, $end])->get();

        $totalAbsensi = $ab->count();
        $totalKeterlambatan = DB::table('absensis')
            ->select(DB::raw('SUM(CAST(keterangan AS UNSIGNED)) as total_sum'))
            ->where('status', 'terlambat')
            ->value('total_sum');
        $jumlah = [
            'hadir' => $ab->where('status', 'hadir')->count(),
            'sakit' => $ab->whereIn('status', 'sakit')->count(),
            'izin' => $ab->whereIn('status', 'izin')->count(),
            'terlambat' => $ab->where('status', 'terlambat')->count(),
            'alfa' => $ab->where('status', 'alfa')->count(),
            'tap' => $ab->where('status', 'TAP')->count(),
        ];
        $persentase = [
            'hadir' => $totalAbsensi > 0 ? round(($jumlah['hadir'] / $totalAbsensi) * 100, 1) : 0,
            'sakit' => $totalAbsensi > 0 ? round(($jumlah['sakit'] / $totalAbsensi) * 100, 1) : 0,
            'izin' => $totalAbsensi > 0 ? round(($jumlah['izin'] / $totalAbsensi) * 100, 1) : 0,
            'terlambat' => $totalAbsensi > 0 ? round(($jumlah['terlambat'] / $totalAbsensi) * 100, 1) : 0,
            'alfa' => $totalAbsensi > 0 ? round(($jumlah['alfa'] / $totalAbsensi) * 100, 1) : 0,
            'tap' => $totalAbsensi > 0 ? round(($jumlah['tap'] / $totalAbsensi) * 100, 1) : 0,
        ];

        return view('walisiswa.laporan', compact('absensi', 'ab', 'siswa', 'totalAbsensi', 'totalKeterlambatan', 'jumlah', 'persentase', 'start', 'end', 'allSiswa'));
    }

    public function sProfil($nis)
    {
        $walisiswa = wali_siswa::where('id_user', Auth::user()->id)->with('user')->first();
        $user = siswa::with('user', 'kelas')->where('nis', $nis)->first();

        return view('walisiswa.sProfil', compact('user'));
    }
}
