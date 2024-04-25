<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LessonController;

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
    Route::get('/detail', [AdminController::class, 'detail'])->name('detail');
    Route::get('/make_account', [AdminController::class, 'make_account'])->name('make_account');
    Route::post('/register', [AdminController::class, 'register'])->name('register');
    Route::get('/accounts', [AdminController::class, 'accounts'])->name('accounts');
    Route::get('/report', [AdminController::class, 'report'])->name('report');
});

Route::middleware(['isLogin', 'cekRole:user'])->group(function(){
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::get('/imt', [AdminController::class, 'imt'])->name('imt');
    Route::get('/explanation', [AdminController::class, 'explanation'])->name('explanation');
    Route::get('/task', [AdminController::class, 'task'])->name('task');
    Route::get('/lesson/{id}', [AdminController::class, 'show'])->name('lesson');
    Route::post('/answer/{lesson_id}/{user_id}', [AdminController::class, 'answer'])->name('answer');});
    Route::get('/nilai', [AdminController::class, 'nilai'])->name('nilai');


Route::middleware(['isLogin', 'cekRole:admin,user'])->group(function(){
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
});

Route::get('/about', function () {
    return view('about');
});

// Route::get('/nilai', function () {
//     return view('nilai');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
});