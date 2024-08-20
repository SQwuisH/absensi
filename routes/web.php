<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliController;
use Illuminate\Support\Facades\Route;

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
Route::get('/home', [HomeController::class, 'index'])->name('home');


//login page
Route::group(['middleware' => 'guest'], function ()
{
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
});


Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        if ($role == 'operator') {
            return redirect('operator');
        } elseif ($role == 'siswa') {
            return redirect('siswa');
        } elseif ($role == 'wali') {
            return redirect('wali');
        }
    }
    return redirect('login');
});




//OPERATOR
Route::group(['middleware' => ['auth', 'roles:operator']], function ()
{
    Route::get('/operator', [OperatorController::class, 'index'])->name('operator');

    Route::get('/kelolakesiswaan', [OperatorController::class, 'kesiswaan'])->name('kesiswaan');
    Route::post('/tambahkesiswaan', [OperatorController::class, 'tambahkesiswaan'])->name('tambahkesiswaan');
    Route::post('/editkesiswaan', [OperatorController::class, 'editkesiswaan'])->name('editkesiswaan');
    Route::delete('/hapuskesiswaan{id}', [OperatorController::class, 'hapuskesiswaan'])->name('hapuskesiswaan');

    Route::get('/kelolawalikelas', [OperatorController::class, 'wali'])->name('wali');
    Route::post('/tambahwalikelas', [OperatorController::class, 'tambahwali'])->name('tambahwali');
    Route::post('/editwalikelas', [OperatorController::class, 'editwali'])->name('editwali');
    Route::delete('/hapuswalikelas/{id}', [OperatorController::class, 'hapuswali'])->name('hapuswali');
    Route::get('/kelolawalikelas/export', [OperatorController::class, 'exportwali'])->name('exportwali');
    Route::post('/kelolawalikelas/import', [OperatorController::class, 'importwali'])->name('imporwali');

    Route::get('/kelolakelas', [OperatorController::class, 'kelas'])->name('kelas');
    Route::get('/kelolakelas/export', [OperatorController::class, 'exportkelas'])->name('exportkelas');
    Route::post('/kelolakelas/import', [OperatorController::class, 'importkelas'])->name('importkelas');
    route::get('/back', [OperatorController::class, 'back'])->name('back');
        Route::get('/kelolakelas/{id}/siswa', [OperatorController::class, 'siswa'])->name('kelassiswa');
        Route::post('/kelolakelas/tambahsiswa', [OperatorController::class, 'tambahSiswa'])->name('tambahSiswa');
        Route::post('/kelolakelas/editsiswa', [OperatorController::class, 'editSiswa'])->name('editSiswa');
        Route::delete('/kelolakelas/hapussiswa{id}', [OperatorController::class, 'hapusSiswa'])->name('hapussiswa');

    Route::post('/tambahkelas', [OperatorController::class, 'tambahkelas'])->name('tambahkelas');
    Route::post('/editkelas', [OperatorController::class, 'editkelas'])->name('editkelas');
    Route::delete('/hapuskelas/{id}', [OperatorController::class, 'hapuskelas'])->name('hapuskelas');

    Route::get('/kelolakoordinat', [OperatorController::class, 'koordinat'])->name('koordinat');
    Route::post('/editkoordinat', [OperatorController::class, 'editkoordinat'])->name('editkoordinat');

    Route::get('/kelolawaktuabsen', [OperatorController::class, 'waktu'])->name('absen');
    route::post('/editwaktuabsen', [OperatorController::class, 'editwaktu'])->name('editabsen');

    Route::get('/kelolajurusan', [OperatorController::class, 'jurusan'])->name('jurusan');
    Route::post('/tambahjurusan', [OperatorController::class, 'tambahjurusan'])->name('tambahjurusan');
    Route::post('/editjurusan', [OperatorController::class, 'editjurusan'])->name('editjurusan');
    Route::delete('/hapusjurusan/{id}', [OperatorController::class, 'hapusjurusan'])->name('hapusjurusan');
});

//KESISWAAN
Route::group(['middleware' => ['auth', 'roles:kesiswaan']], function ()
{
    Route::get('/kesiswaan', [KesiswaanController::class, 'index'])->name('kesiswaan');
});

//WALI KELAS
Route::group(['middleware' => ['auth', 'roles:wali']], function ()
{
    Route::get('/wali', [WaliController::class, 'index'])->name('wali');
});

//SISWA
Route::group(['middleware' => ['auth', 'roles:siswa']], function ()
{
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswa/absen', [SiswaController::class, 'absen'])->name('absen');
    Route::post('/absen', [SiswaController::class, 'kirimabsen'])->name('kirimabsen');
    Route::get('/pengajuan/{opt}', [SiswaController::class, 'izinSakit'])->name('izinSakit');
    Route::post('/pengajuan', [SiswaController::class, 'krmizinSakit'])->name('krmizinSakit');
    Route::get('/siswa/profil', [SiswaController::class, 'profil'])->name('sProfil');
    Route::get('/siswa/laporan', [SiswaController::class, 'laporan'])->name('sLaporan');
});
