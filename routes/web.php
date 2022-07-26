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
Route::get('search', function (\App\Repositories\WorkersRepository $repository) {
    $workers = $repository->search(request('q'));

    return view('worker.index', compact('workers'));
});
