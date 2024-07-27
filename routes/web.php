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

    Route::get('/kelolawalikelas', [App\Http\Controllers\OperatorController::class, 'wali'])->name('wali');
    Route::post('/tambahwalikelas', [App\Http\Controllers\OperatorController::class, 'tambahwali'])->name('tambahwali');
    Route::post('/editwalikelas', [App\Http\Controllers\OperatorController::class, 'editwali'])->name('editwali');

    Route::get('/kelolakelas', [App\Http\Controllers\OperatorController::class, 'kelas'])->name('kelas');

    Route::get('/kelolakoordinat', [App\Http\Controllers\OperatorController::class, 'koordinat'])->name('koordinat');

    Route::get('/kelolawaktuabsen', [App\Http\Controllers\OperatorController::class, 'absen'])->name('absen');

    Route::get('/kelolajurusan', [App\Http\Controllers\OperatorController::class, 'jurusan'])->name('jurusan');
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
    Route::get('/siswa', [App\Http\Controllers\SiswaController::class, 'index'])->name('siswa');
});
