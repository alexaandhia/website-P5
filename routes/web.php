<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\P5Controller;

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

Route::get('/', [P5Controller::class, 'index'])->name('index');
Route::get('/login', [P5Controller::class, 'login'])->name('login');
Route::post('/auth', [P5Controller::class, 'auth'])->name('auth');
Route::get('/logout', [P5Controller::class, 'logout'])->name('logout');

Route::get('/admin', [P5Controller::class, 'admin'])->name('admin');
Route::get('/user', [P5Controller::class, 'user'])->name('user');


Route::get('/about', function () {
    return view('about');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});