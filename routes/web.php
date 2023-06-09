<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

Route::get('/a', function () {
    return view('create');
});

Route::resource('articles', ArticleController::class);

Route::post('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');

Route::get('/article/cetak_pdf', [ArticleController::class, 'cetak_pdf'])->name('articles.cetak');