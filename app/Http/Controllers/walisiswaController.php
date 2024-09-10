<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\siswa;
use App\Models\User;
use App\Models\wali_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class walisiswaController extends Controller
{
    public function index()
    {
        $walisiswa = wali_siswa::where('id_user', Auth::user()->id)->with('user')->first();
        $siswa = siswa::with('user', 'kelas')->where('nik', $walisiswa->nik)->get();
        $int = 0;
        $siswa = $siswa->toArray();
        foreach ($siswa as $s) {
            $nama[] = strtoLower($s["user"]["name"]);
            $semua = absensi::where('nis', $s["nis"])->get();
            $ini = absensi::whereYear('date', date('Y'))
                ->where('nis', $s["nis"])
                ->whereMonth('date', date('m'))->get();
            $lalu = absensi::whereYear('date', date('Y'))
                ->where('nis', $s["nis"])
                ->whereMonth('date', date('m', strtotime('first day of previous month')))->get();

            $jumlah[] = [
                // SEMUA
                'semua' => $semua->count(),
                'hadirSemua' => $semua->where('status', "hadir")->count(),
                'sakitSemua' => $semua->where('status', "sakit")->count(),
                'izinSemua' => $semua->where('status', "izin")->count(),
                'terlambatSemua' => $semua->where('status', "terlambat")->count(),
                'alfaSemua' => $semua->where('status', "alfa")->count(),
                'tapSemua' => $semua->where('status', "TAP")->count(),

                // BULAN INI
                'ini' => $ini->count(),
                'hadirIni' => $ini->where('status', "hadir")->count(),
                'sakitIni' => $ini->where('status', "sakit")->count(),
                'izinIni' => $ini->where('status', "izin")->count(),
                'terlambatIni' => $ini->where('status', "terlambat")->count(),
                'alfaIni' => $ini->where('status', "alfa")->count(),
                'tapIni' => $ini->where('status', "TAP")->count(),

                // BULAN LALU
                'lalu' => $lalu->count(),
                'hadirLalu' => $lalu->where('status', "hadir")->count(),
                'sakitLalu' => $lalu->where('status', "sakit")->count(),
                'izinLalu' => $lalu->where('status', "izin")->count(),
                'terlambatLalu' => $lalu->where('status', "terlambat")->count(),
                'alfaLalu' => $lalu->where('status', "alfa")->count(),
                'tapLalu' => $lalu->where('status', "TAP")->count(),
            ];
            $persentase[] = [
                'semua' => $jumlah["$int"]['hadirSemua'] > 0 ? round(($jumlah["$int"]['hadirSemua'] / $jumlah["$int"]['semua']) * 100, 1) :0,
                'ini' => $jumlah["$int"]['hadirIni'] > 0 ? round(($jumlah["$int"]['hadirIni'] / $jumlah["$int"]['ini']) * 100, 1) : 0,
                'lalu' => $jumlah["$int"]['hadirLalu'] > 0 ? round(($jumlah["$int"]['hadirLalu'] / $jumlah["$int"]['lalu']) * 100, 1) : 0
            ];

            $int = $int + 1;
        }

        return view('walisiswa.index', compact('walisiswa', 'siswa', 'ini', 'lalu', 'jumlah', 'persentase'));
    }

    public function profil()
    {
        $walisiswa = wali_siswa::where('id_user', Auth::user()->id)->with('user')->first();
        $siswa = siswa::with('user', 'kelas')->where('nik', $walisiswa->nik)->get();

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
}
