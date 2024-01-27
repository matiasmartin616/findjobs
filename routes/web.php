<?php

use App\Models\Joblisting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JoblistingController;
use App\Http\Controllers\UserController;
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

Route::get('/', [JoblistingController::class, 'index']);

Route::get('/joblisting/create', [JoblistingController::class, 'create'])->middleware('auth');

Route::post('/joblisting/store', [JoblistingController::class, 'store'])->middleware('auth');

Route::get('/joblisting/manage', [JoblistingController::class, 'manage'])->name('joblisting.manage')->middleware('auth');

Route::get('/joblisting/{joblisting}', [JoblistingController::class, 'show'])->name('joblisting.show');

Route::get('/joblisting/{joblisting}/edit', [JoblistingController::class, 'edit'])->middleware('auth');

Route::put('/joblisting/{joblisting}', [JoblistingController::class, 'update'])->middleware('auth');

Route::delete('/joblisting/{joblisting}', [JoblistingController::class, 'delete'])->middleware('auth');

Route::get('/register', [UserController::class, 'create'])->name('users.create')->middleware('guest');

Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('guest');

Route::post('/logout', [UserController::class, 'logout'])->name('users.logout')->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('users.authenticate');
