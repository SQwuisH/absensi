<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\koordinat_sekolah;
use App\Models\siswa;
use App\Models\waktu_absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $waktu = waktu_absen::first();

        $siswa = siswa::with('user')->where('id_user', auth::user()->id)->first();

        $cekabsen = absensi::with('siswa')->where('date', date('Y-m-d'))->where('nis', $siswa->nis)->first();

        $absenmasuk = false;
        $absenpulang = false;

        $statusAbsen = $cekabsen ? $cekabsen->status : 'belum absen';

        $lokasi = koordinat_sekolah::first();

        if ($cekabsen) {
            $absenmasuk = !empty($cekabsen->photo_in);
            $absenpulang = !empty($cekabsen->photo_out);
        }

        return view('siswa.index', [
            'waktu' => $waktu,
            'cekabsen' => $cekabsen,
            'absenmasuk' => $absenmasuk,
            'absenpulang' => $absenpulang,
            'statusabsen' => $statusAbsen,
            'lokasi' => $lokasi
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
        if (date('H:i:s') > $waktu->batas_masuk)
        {
            $status = 'terlambat';
        }
        $date = date("Y-m-d");
        $jam = date("H:i:s");

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
        $formatName = $siswa->nis . "-" . $date;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        $j = $radius - $radiussekolah;

        // Get face confidence
        $faceConfidence = $request->faceConfidence;

        $cek = absensi::where('date', $date)->where('nis', $siswa->nis)->count();
        if ($radius > $radiussekolah) {
            echo "error|Anda Berada Diluar Radius, Jarak Anda lebih dari " . $j . " meter dari Radius Sekolah|";
        } elseif ($faceConfidence < 0.90) { // Confidence threshold
            echo "error|Wajah Tidak Terdeteksi dengan Kepastian 90%|";
        } else {
            if ($cek > 0) {
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
                $data = [
                    'nis' => "00$siswa->nis",
                    'status' => $status,
                    'date' => $date,
                    'jam_masuk' => $jam,
                    'titik_koordinat_masuk' => $lokasiSiswa,
                    'foto_masuk' => $fileName,
                ];

                $simpan = DB::table('absensis')->insert($data);

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
        return redirect()->back()->with('success');
    }
}
