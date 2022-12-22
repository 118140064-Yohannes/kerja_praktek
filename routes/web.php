p<?php

use App\Models\Employee;
use App\Models\Jurnal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\JurnalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $jumlahpegawai = Employee::count();
    $jumlahhadir = Jurnal::count();

    return view('welcome' , compact('jumlahpegawai' , 'jumlahhadir'));
})->name('awal')->middleware('auth');
Route::post('/insertabsen', [JurnalController::class, 'insertabsen'])->name('insertabsen');
Route::get('/deleteabsen/{id}', [JurnalController::class, 'deleteabsen'])->name('deleteabsen');

Route::get('/pegawai', [EmployeesController::class, 'index'])->name('pegawai')->middleware('auth');

Route::get('/tambahpegawai', [EmployeesController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata', [EmployeesController::class, 'insertdata'])->name('insertdata');

Route::get('/tampilkandata/{id}', [EmployeesController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}', [EmployeesController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}', [EmployeesController::class, 'delete'])->name('delete');


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');


Route::get('/harian', [JurnalController::class, 'harian'])->name('harian');
Route::get('/bulanan', [JurnalController::class, 'bulanan'])->name('bulanan');


Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//Export Excel
Route::get('/exportexcel', [JurnalController::class, 'exportexcel'])->name('exportexcel');


