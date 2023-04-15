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

Auth::routes();


use App\Http\Controllers\HomeController;
Route::controller(HomeController::class)->middleware('auth')->group(function() {
    Route::get('home', 'index')->name('home');
});



use App\Http\Controllers\BlogController;

Route::middleware(['auth'])->group(function () {
    Route::get('blog/create', [BlogController::class, 'add'])->name('blog.add');
    Route::post('blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('blog/{id}/update', [BlogController::class, 'update'])->name('blog.update');
    Route::get('blog/{id}/delete', [BlogController::class, 'delete'])->name('blog.delete');
    Route::get('blog/{id}/show', [BlogController::class, 'show'])->name('blog.show');
    
});



use App\Http\Controllers\BoardController;

Route::middleware('auth')->group(function() {
    Route::get('board/create', [BoardController::class, 'add'])->name('board.add');
    Route::post('board/create', [BoardController::class, 'create'])->name('board.create');
    Route::get('board', [BoardController::class, 'index'])->name('board.index');
    Route::get('board/edit/{id}', [BoardController::class, 'edit'])->name('board.edit');
    Route::post('board/update/{id}', [BoardController::class, 'update'])->name('board.update');
    Route::get('board/delete/{id}', [BoardController::class, 'delete'])->name('board.delete');
    Route::get('board/{id}/show', [BoardController::class, 'show'])->name('board.show');
});


use App\Http\Controllers\BoardCommentController;

Route::middleware('auth')->group(function() {
    Route::get('boardcom/create', [BoardCommentController::class, 'add'])->name('boardcom.add');