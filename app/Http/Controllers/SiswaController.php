<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\absensi;
use App\Models\koordinat_sekolah;
use App\Models\siswa;
use App\Models\User;
use App\Models\waktu_absen;
use Carbon\Carbon;
use Code16\CarbonBusiness\BusinessDays;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {

        $siswa = siswa::with('user')->where('id_user', auth::user()->id)->first();
        $waktu = waktu_absen::first();
        $lokasi = koordinat_sekolah::first();

        $startMonthNow = carbon::now()->startOfMonth();
        $endMonthNow = carbon::now()->endOfMonth();

        $startMonthBefore = new Carbon('first day of last month');
        $endMonthBefore = new Carbon('last day of last month');

        $dateNow = new BusinessDays();
        $dateBefore = new BusinessDays();

        $daysNow = $dateNow->daysBetween(
            Carbon::createFromDate($startMonthNow),
            Carbon::createFromDate( $endMonthNow)
        );

        $daysBefore = $dateBefore->daysBetween(
            Carbon::createFromDate($startMonthBefore),
            Carbon::createFromDate( $endMonthBefore)
        );

        // CEK ABSENSI
        $cekabsen = absensi::with('absensi')->where('date', date('Y-m-d'))->where('nis', $siswa->nis)->first();
        if ($cekabsen) {
            if(date("H:i:s") < $waktu->mulai_absen)
            {
                $statusAbsen = "belum waktu presen";
            }
            elseif($cekabsen->status == "alfa" && date("H:i:s") < $waktu->mulai_pulang)
            {
                $statusAbsen = "belum presen";
            }
            elseif(($cekabsen->status == 'hadir' || $cekabsen->status == 'terlambat') && date("H:i:s") > $waktu->mulai_pulang)
            {
                $statusAbsen = "belum pulang";
            }
            elseif($cekabsen->foto_pulang)
            {
                $statusAbsen = "sudah pulang";
            }
            else
            {
                $statusAbsen = $cekabsen->status;
            }
        }
        else
        {
            $statusAbsen = "libur";
        }

        // REKAP DASHBOARD
        $ini = Absensi::whereYear('date', date('Y'))
            ->where('nis', $siswa->nis)
            ->whereMonth('date', date('m'))->get();

        $lalu = Absensi::whereYear('date', date('Y'))
            ->where('nis', $siswa->nis)
            ->whereMonth('date', date('m', strtotime('first day of previous month')))->get();

        $jumlah = [
            // BULAN INI
            'ini' => $ini->count(),
            'hadirIni' => $ini->whereIn('status', ["hadir", "terlambat", "TAP"])->count(),
            'tidakHadirIni' => $ini->whereIn('status', ["sakit", "izin", "alfa"])->count(),

            // BULAN LALU
            'lalu' => $lalu->count(),
            'hadirLalu' => $lalu->whereIn('status', "hadir")->count(),
            'tidakHadirLalu' => $lalu->whereIn('status', "sakit")->count(),
        ];

        $persentase = [
            'ini' => $jumlah['hadirIni'] > 0 ? round(($jumlah['hadirIni'] / $daysNow) * 100, 1) : 0,
            'lalu' => $jumlah['hadirLalu'] > 0 ? round(($jumlah['hadirLalu'] / $daysBefore) * 100, 1) : 0
        ];

        return view('siswa.index', [
            'waktu' => $waktu,
            'cekabsen' => $cekabsen,
            'statusabsen' => $statusAbsen,
            'lokasi' => $lokasi,
            'jumlah' => $jumlah,
            'persentase' => $persentase
        ]);
    }

    public function absen()
    {

        $user = Auth::user();

        $date = date("Y-m-d");
        $cek = absensi::where('date', $date)->where('nis', $user->nis)->count();

        $lokasi = koordinat_sekolah::first();
        $waktu = waktu_absen::first();

        return view('siswa.absen', compact('cek', 'lokasi', 'waktu'));
    }

    public function kirimabsen(request $request)
    {
        $user = Auth::user();
        $siswa = siswa::where('id_user', $user->id)->first();
        $waktu = waktu_absen::first();
        $status = 'hadir';
        $ket = null;
        $date = date("Y-m-d");
        $jam = date("H:i:s");


        if (date('H:i:s') > $waktu->batas_masuk) {
            $status = 'terlambat';
        }

        $lokasiSiswa = $request->lokasi;
        $lokasiuser = explode(",", $lokasiSiswa);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $lok_sekolah = Koordinat_Sekolah::first();
        $radiussekolah = $lok_sekolah->radius;
        $lok = explode(",", $lok_sekolah->titik_koordinat);
        $latitudesekolah = $lok[0];
        $longitudesekolah = $lok[1];
        $jarak = $this->distance($latitudesekolah, $longitudesekolah, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $j = $radius - $radiussekolah;

        // Get face confidence
        $faceConfidence = $request->faceConfidence;

        $cek = absensi::where('date', $date)->where('nis', $siswa->nis)->first();
        if ($radius > $radiussekolah) {
            echo "error|Anda Berada Diluar Radius, Jarak Anda lebih dari " . $j . " meter dari Radius Sekolah|";
        } elseif ($faceConfidence < 0.90) { // Confidence threshold
            echo "error|Wajah Tidak Terdeteksi dengan Kepastian 90%|";
        } else {
            if ($cek->count() > 0 && $cek->status != "alfa") {
                $formatName = $siswa->nis . "-" . $date . "-pulang";
                $fileName = $formatName . ".png";
                $file = $folderPath . $fileName;
                $data_pulang = [
                    'jam_pulang' => $jam,
                    'titik_koordinat_pulang' => $lokasiSiswa,
                    'foto_pulang' => $fileName
                ];
                $update = absensi::where('date', $date)->where('nis', "00$siswa->nis")->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih, Hati-Hati Dijalan!|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen Gagal|out";
                }
            } else {
                $formatName = $siswa->nis . "-" . $date . "-masuk";
                $fileName = $formatName . ".png";
                $file = $folderPath . $fileName;
                $data = [
                    'nis' => "00$siswa->nis",
                    'status' => $status,
                    'date' => $date,
                    'keterangan' => $ket,
                    'jam_masuk' => $jam,
                    'titik_koordinat_masuk' => $lokasiSiswa,
                    'foto_masuk' => $fileName,
                ];

                $simpan = absensi::where('date', $date)->where('nis', "00$siswa->nis")->update($data);

                if ($simpan) {
                    echo "success|Terimakasih, Selamat Belajar!|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen Gagal|in";
                }
            }
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5200;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function izinSakit($opt)
    {
        return view('siswa.izinSakit', compact('opt'));
    }

    public function krmizinSakit(Request $r)
    {
        $r->validate([
            'foto_masuk' => 'required|mimes:jpeg,png,jpg,pdf|max:10000',
            'keterangan' => 'required|string|max:255',
            'opt' => 'required|string',
        ]);

        if ($r->hasFile('foto_masuk')) {
            $siswa = siswa::where('id_user', auth::user()->id)->first();
            $date =  date("Y-m-d");
            $nis = "00$siswa->nis";
            $status = $r->opt;

            $foto = $r->file('foto_masuk');

            $folderPath = "public/uploads/absensi/";

            $extension = $foto->getClientOriginalExtension();
            $fileName = $nis . "-" . $date . "-" . $status . "." . $extension;
            $file = $folderPath . $fileName;


            $update = absensi::where('nis', $nis)->where('date', $date);

            $simpan = $update->update([
                'nis' => $nis,
                'status' => $r->opt,
                'foto_masuk' => $fileName,
                'keterangan' => $r->keterangan,
                'date' => $date
            ]);

            if ($simpan) {
                Storage::put($file, file_get_contents($foto));
                return redirect()->route('siswa')->with('success', 'Pengajuan ' . $status . ' Berhasil Disimpan');
            } else {
                return redirect()->back()->with('error');
            }
        }
    }

    public function profil()
    {
        $user = siswa::where("id_user", auth::user()->id)->with('user', 'kelas')->first();

        return view('siswa.profil', compact('user'));
    }

    public function editprofil(Request $r)
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

    public function laporan(request $request)
    {
        $siswa = siswa::where('id_user', auth::user()->id)->first();
        $nis = $siswa->nis;
        $query = absensi::query()->orderBy('date', 'desc')->where('nis', '00' . $nis);

        $s = absensi::orderBy('date', 'asc')->first();

        $start = $s->date;
        $end = date("Y-m-d");

        $date = Str::of($request->daterange)->remove('-')->replace('/', '-')->split('/[\s,]+/');
        if (isset($request->daterange)) {
            $start = DateTime::createFromFormat("m-d-Y", $date[0])->format("Y-m-d");
            $end = DateTime::createFromFormat("m-d-Y", $date[1])->format("Y-m-d");
        }
        if (isset($request->category) && $request->category != null) {
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
            'sakit' => $ab->where('status', 'sakit')->count(),
            'izin' => $ab->where('status', 'izin')->count(),
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

        return view('siswa.laporan', compact('absensi', 'ab', 'siswa', 'totalAbsensi', 'totalKeterlambatan', 'jumlah', 'persentase', 'start', 'end'));
    }
}
