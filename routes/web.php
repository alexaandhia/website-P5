<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/tes', function () {
//     return view('form-admin');
// });

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/auth', [AdminController::class, 'auth'])->name('auth');

Route::get('/error', [AdminController::class, 'error'])->name('error');

Route::middleware(['isLogin', 'cekRole:admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/form', [AdminController::class, 'form'])->name('form');
    Route::post('/add', [AdminController::class, 'store'])->name('add');

});

Route::middleware(['isLogin', 'cekRole:user'])->group(function(){
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::get('/user', [AdminController::class, 'user'])->name('user');

});

Route::middleware(['isLogin', 'cekRole:admin,user'])->group(function(){
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});