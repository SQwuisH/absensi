<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

//login page
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [App\Http\Controllers\login::class, 'index'])->name('login');
    Route::post('/postlogin', [App\Http\Controllers\login::class, 'postlogin'])->name('postlogin');
});

// Routing middleware
Route::get('/login', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        if ($role == 'operator') {
            return redirect('operator');
        } elseif ($role == 'siswa') {
            return redirect('siswa');
        } elseif ($role == 'wali') {
            return redirect('wali');
        } elseif ($role == 'kesiswaan') {
            return redirect('kesiswaan');
        } elseif ($role == 'wali siswa') {
            return redirect('walisiswa');
        }
    }
    return route('login');
})->name('redirect');

//OPERATOR
Route::group(['middleware' => ['auth', 'roles:operator']], function () {
    //LANDING PAGE
    Route::get('/operator', [App\Http\Controllers\OperatorController::class, 'index'])->name('operator');

    Route::post('/editkoordinat', [App\Http\Controllers\OperatorController::class, 'editkoordinat'])->name('editkoordinat');
    route::post('/editwaktuabsen', [App\Http\Controllers\OperatorController::class, 'editwaktu'])->name('editabsen');

    // PROFIL
    Route::get('/operator/profil', [App\Http\Controllers\OperatorController::class, 'profil'])->name('operatorProfil');
    Route::get('/operator/profilUpdate', [App\Http\Controllers\OperatorController::class, 'profilUpdate'])->name('operatorProfilUpdate');

    //KESISWAAN
    Route::get('/kelolakesiswaan', [App\Http\Controllers\OperatorController::class, 'kesiswaan'])->name('OPkesiswaan');
    Route::post('/tambahkesiswaan', [App\Http\Controllers\OperatorController::class, 'addkesiswaan'])->name('addkesiswaan');
    Route::post('/editkesiswaan', [App\Http\Controllers\OperatorController::class, 'editkesiswaan'])->name('editkesiswaan');
    Route::delete('/hapuskesiswaan{id}', [App\Http\Controllers\OperatorController::class, 'deletekesiswaan'])->name('deletekesiswaan');

    //WALI KELAS
    Route::get('/kelolawalikelas', [App\Http\Controllers\OperatorWaliKelas::class, 'index'])->name('OPwalikelas');
    Route::post('/tambahwalikelas', [App\Http\Controllers\OperatorWaliKelas::class, 'add'])->name('addwalikelas');
    Route::post('/editwalikelas', [App\Http\Controllers\OperatorWaliKelas::class, 'edit'])->name('editwalikelas');
    Route::delete('/hapuswalikelas/{id}', [App\Http\Controllers\OperatorWaliKelas::class, 'delete'])->name('deletewalikelas');
    Route::get('/exportwalikelas', [App\Http\Controllers\OperatorWaliKelas::class, 'formatWalikelas'])->name('formatwalikelas');
    Route::post('/importawalikelas', [App\Http\Controllers\OperatorWaliKelas::class, 'importWalikelas'])->name('imporwali');

    //WALI SISWA
    Route::get('/kelolawalisiswa', [App\Http\Controllers\OperatorWaliSiswa::class, 'index'])->name('OPwalisiswa');
    Route::post('/tambahwalisiswa', [App\Http\Controllers\OperatorWaliSiswa::class, 'add'])->name('addwalisiswa');
    Route::post('/editwalisiswa', [App\Http\Controllers\OperatorWaliSiswa::class, 'edit'])->name('editwalisiswa');
    Route::delete('/hapuswalisiswa/{id}', [App\Http\Controllers\OperatorWaliSiswa::class, 'delete'])->name('deletewalisiswa');
    Route::get('/formatwalisiswa', [App\Http\Controllers\OperatorWaliSiswa::class, 'formatWaliSiswa'])->name('formatwalisiswa');
    Route::post('/importawalisiswa', [App\Http\Controllers\OperatorWaliSiswa::class, 'importWaliSiswa'])->name('imporwalisiswa');

    //KELAS
    Route::get('/kelolakelas', [App\Http\Controllers\OperatorController::class, 'kelas'])->name('OPkelas');
    Route::get('/kelolakelas/{id}/siswa', [App\Http\Controllers\OperatorController::class, 'siswa'])->name('OPkelassiswa');
    Route::post('/tambahkelas', [App\Http\Controllers\OperatorController::class, 'addkelas'])->name('addkelas');
    Route::post('/editkelas', [App\Http\Controllers\OperatorController::class, 'editkelas'])->name('editkelas');
    Route::delete('/hapuskelas/{id}', [App\Http\Controllers\OperatorController::class, 'deletekelas'])->name('deletekelas');


    //SISWA
    Route::get('/kelolasiswa', [App\Http\Controllers\OperatorSiswa::class, 'index'])->name('OPsiswa');
    Route::get('/kelolasiswa/export', [App\Http\Controllers\OperatorSiswa::class, 'formatsiswa'])->name('formatsiswa');
    Route::post('/kelolasiswa/import', [App\Http\Controllers\OperatorSiswa::class, 'importsiswa'])->name('importsiswa');
    Route::post('/tambahsiswa', [App\Http\Controllers\OperatorSiswa::class, 'add'])->name('addSiswa');
    Route::post('/editsiswa', [App\Http\Controllers\OperatorSiswa::class, 'edit'])->name('editSiswa');
    Route::delete('/hapussiswa/{id}', [App\Http\Controllers\OperatorSiswa::class, 'delete'])->name('deletesiswa');

    //JURUSAN
    Route::get('/kelolajurusan', [App\Http\Controllers\OperatorController::class, 'jurusan'])->name('OPjurusan');
    Route::post('/tambahjurusan', [App\Http\Controllers\OperatorController::class, 'addjurusan'])->name('addjurusan');
    Route::post('/editjurusan', [App\Http\Controllers\OperatorController::class, 'editjurusan'])->name('editjurusan');
    Route::delete('/hapusjurusan/{id}', [App\Http\Controllers\OperatorController::class, 'deletejurusan'])->name('deletejurusan');
});

//KESISWAAN
Route::group(['middleware' => ['auth', 'roles:kesiswaan']], function () {
    Route::get('/kesiswaan', [App\Http\Controllers\KesiswaanController::class, 'index'])->name('kesiswaan');

    Route::get('/kesiswaan/profil', [App\Http\Controllers\KesiswaanController::class, 'profil'])->name('kesiswaanProfil');
    Route::post('/kesiswaan/profil/edit', [App\Http\Controllers\KesiswaanController::class, 'editProfil'])->name('kesiswaanEditProfil');

    // Laporan Kelas
    Route::get('/kesiswaan/laporan', [App\Http\Controllers\KesiswaanController::class, 'laporan'])->name('kesiswaanLaporan');
    Route::get('/kesiswaan/laporan/kelas/{kelas}', [App\Http\Controllers\KesiswaanController::class, 'laporanKelas'])->name('kesiswaanLaporanKelas');

    // Laporan Siswa
    Route::get('/kesiswaan/laporan/siswa/{siswa}', [App\Http\Controllers\KesiswaanController::class, 'laporanSiswa'])->name('kesiswaanLaporanSiswa');
});

//WALI KELAS
Route::group(['middleware' => ['auth', 'roles:wali']], function () {
    Route::get('/wali', [App\Http\Controllers\WaliController::class, 'index'])->name('wali');

    Route::get('/wali/laporan', [App\Http\Controllers\WaliController::class, 'laporan'])->name('waliLaporan');
    Route::get('/wali/laporan/{siswa}', [App\Http\Controllers\WaliController::class, 'laporanSiswa'])->name('waliLaporanSiswa');

    Route::get('/wali/profil', [App\Http\Controllers\WaliController::class, 'profil'])->name('waliProfil');
    Route::get('/wali/profil/{siswa}', [App\Http\Controllers\WaliController::class, 'profil'])->name('waliSiswaProfil');
    Route::get('/wali/profil/update', [App\Http\Controllers\WaliController::class, 'update'])->name('waliProfilUpdate');

});

//SISWA
Route::group(['middleware' => ['auth', 'roles:siswa']], function () {
    Route::get('/siswa', [App\Http\Controllers\SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswa/absen', [App\Http\Controllers\SiswaController::class, 'absen'])->name('absen');
    Route::post('/absen', [App\Http\Controllers\SiswaController::class, 'kirimabsen'])->name('kirimabsen');
    Route::get('/pengajuan/{opt}', [App\Http\Controllers\SiswaController::class, 'izinSakit'])->name('izinSakit');
    Route::post('/pengajuan', [App\Http\Controllers\SiswaController::class, 'krmizinSakit'])->name('krmizinSakit');
    Route::get('/siswa/profil', [App\Http\Controllers\SiswaController::class, 'profil'])->name('sProfil');
    Route::post('/siswa/editprofil', [App\Http\Controllers\SiswaController::class, 'editprofil'])->name('sEditprofil');
    Route::get('/siswa/laporan', [App\Http\Controllers\SiswaController::class, 'laporan'])->name('sLaporan');
});

// WALI SISWA
Route::group(['middleware' => ['auth', 'roles:wali siswa']], function () {
    Route::get('/walisiswa', [App\Http\Controllers\WaliSiswaController::class, 'index'])->name('walisiswa');
    Route::get('/walisiswa/laporan/{nis}', [App\Http\Controllers\WaliSiswaController::class, 'laporan'])->name('wLaporan');
    Route::get('/walisiswa/profil', [App\Http\Controllers\WaliSiswaController::class, 'profil'])->name('wProfil');
    Route::get('/walisiswa/profil/{nis}', [App\Http\Controllers\WaliSiswaController::class, 'sProfil'])->name('wsProfil');
    Route::post('/walisiswa/editprofil', [App\Http\Controllers\WaliSiswaController::class, 'editprofil'])->name('wEditProfil');
});
