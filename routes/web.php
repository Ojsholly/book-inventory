<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Book\BookController;

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

Route::middleware('auth')->group(function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::get('/books/archive', [BookController::class, 'archives']);
    Route::post('/books/archive/{id}', [BookController::class, 'archive'])->name('books.archive');
    Route::post('/books/restore/{id}', [BookController::class, 'restore'])->name('books.restore');
    Route::resource('/books', BookController::class);

});