<?php

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//login page
Route::group(['middleware' => 'guest'], function ()
{
    Route::get('/login', [App\Http\Controllers\login::class, 'index'])->name('login');
    Route::post('/postlogin', [App\Http\Controllers\login::class, 'postlogin'])->name('postlogin');
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
    Route::get('/operator', [App\Http\Controllers\OperatorController::class, 'index'])->name('operator');

    Route::get('/kelolakesiswaan', [App\Http\Controllers\OperatorController::class, 'kesiswaan'])->name('kesiswaan');
    Route::post('/tambahkesiswaan', [App\Http\Controllers\OperatorController::class, 'tambahkesiswaan'])->name('tambahkesiswaan');
    Route::post('/editkesiswaan', [App\Http\Controllers\OperatorController::class, 'editkesiswaan'])->name('editkesiswaan');
    Route::delete('/hapuskesiswaan{id}', [App\Http\Controllers\OperatorController::class, 'hapuskesiswaan'])->name('hapuskesiswaan');

    Route::get('/kelolawalikelas', [App\Http\Controllers\OperatorController::class, 'wali'])->name('wali');
    Route::post('/tambahwalikelas', [App\Http\Controllers\OperatorController::class, 'tambahwali'])->name('tambahwali');
    Route::post('/editwalikelas', [App\Http\Controllers\OperatorController::class, 'editwali'])->name('editwali');
    Route::delete('/hapuswalikelas/{id}', [App\Http\Controllers\OperatorController::class, 'hapuswali'])->name('hapuswali');
    Route::get('/kelolawalikelas/export', [App\Http\Controllers\OperatorController::class, 'exportwali'])->name('exportwali');
    Route::post('/kelolawalikelas/import', [App\Http\Controllers\OperatorController::class, 'importwali'])->name('imporwali');

    Route::get('/kelolakelas', [App\Http\Controllers\OperatorController::class, 'kelas'])->name('kelas');
    Route::get('/kelolakelas/export', [App\Http\Controllers\OperatorController::class, 'exportkelas'])->name('exportkelas');
    Route::post('/kelolakelas/import', [App\Http\Controllers\OperatorController::class, 'importkelas'])->name('importkelas');
    route::get('/back', [App\Http\Controllers\OperatorController::class, 'back'])->name('back');
        Route::get('/kelolakelas/{id}/siswa', [App\Http\Controllers\OperatorController::class, 'siswa'])->name('kelassiswa');
        Route::post('/kelolakelas/tambahsiswa', [App\Http\Controllers\OperatorController::class, 'tambahSiswa'])->name('tambahSiswa');
        Route::post('/kelolakelas/editsiswa', [App\Http\Controllers\OperatorController::class, 'editSiswa'])->name('editSiswa');
        Route::delete('/kelolakelas/hapussiswa{id}', [App\Http\Controllers\OperatorController::class, 'hapusSiswa'])->name('hapussiswa');

    Route::post('/tambahkelas', [App\Http\Controllers\OperatorController::class, 'tambahkelas'])->name('tambahkelas');
    Route::post('/editkelas', [App\Http\Controllers\OperatorController::class, 'editkelas'])->name('editkelas');
    Route::delete('/hapuskelas/{id}', [App\Http\Controllers\OperatorController::class, 'hapuskelas'])->name('hapuskelas');

    Route::get('/kelolakoordinat', [App\Http\Controllers\OperatorController::class, 'koordinat'])->name('koordinat');
    Route::post('/editkoordinat', [App\Http\Controllers\OperatorController::class, 'editkoordinat'])->name('editkoordinat');

    Route::get('/kelolawaktuabsen', [App\Http\Controllers\OperatorController::class, 'waktu'])->name('absen');
    route::post('/editwaktuabsen', [App\Http\Controllers\OperatorController::class, 'editwaktu'])->name('editabsen');

    Route::get('/kelolajurusan', [App\Http\Controllers\OperatorController::class, 'jurusan'])->name('jurusan');
    Route::post('/tambahjurusan', [App\Http\Controllers\OperatorController::class, 'tambahjurusan'])->name('tambahjurusan');
    Route::post('/editjurusan', [App\Http\Controllers\OperatorController::class, 'editjurusan'])->name('editjurusan');
    Route::delete('/hapusjurusan/{id}', [App\Http\Controllers\OperatorController::class, 'hapusjurusan'])->name('hapusjurusan');
});

//KESISWAAN
Route::group(['middleware' => ['auth', 'roles:kesiswaan']], function ()
{
    Route::get('/kesiswaan', [App\Http\Controllers\KesiswaanController::class, 'index'])->name('kesiswaan');
});

//WALI KELAS
Route::group(['middleware' => ['auth', 'roles:wali']], function ()
{
    Route::get('/wali', [App\Http\Controllers\WaliController::class, 'index'])->name('wali');
});

//SISWA
Route::group(['middleware' => ['auth', 'roles:siswa']], function ()
{
    Route::resource('siswa', App\Http\Controllers\siswaController::class);
});
