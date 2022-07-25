<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/workers', ['App\Http\Controllers\Workers\WorkerController', 'index'])->name('worker_index');

Route::get('/file-index', ['App\Http\Controllers\Files\FileController', 'index'])->name('index-file');
Route::get('/download-file/{id}', ['App\Http\Controllers\Files\FileController', 'download'])->name('download_file');
Route::get('/store-file', ['App\Http\Controllers\Files\FileController', 'store'])->name('store-file');
Route::get('/delete-file/{id}', ['App\Http\Controllers\Files\FileController', 'delete'])->name('delete_file');
Route::post('/create_file', ['App\Http\Controllers\Files\FileController', 'create'])->name('create_file');
Route::get('/draw_img', ['App\Http\Controllers\Files\FileController', 'draw_img'])->name('draw_img');
