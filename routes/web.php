<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('auth.login');
});

Auth::routes();


Route::get('home',[PostController::class,'post'])->name('home');
Route::post('home/deletecomment',[PostController::class,'delete'])->name('commentBTN');
Route::post('user/deletecomment',[PostController::class,'delete'])->name('commentprofBTN');
Route::post('comment/deleteall',[PostController::class,'deleteall'])->name('allcommentprofBTN');
Route::get('post/{id}', [PostController::class, 'comment'])->name('commentshow');
Route::post('post',[PostController::class,'addPost'])->name('addpost');



Route::get('user', [App\Http\Controllers\HomeController::class, 'index'])->name('user');

Route::post('/updateProfile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');

Route::get('search', [App\Http\Controllers\PostController::class, 'search'])->name('search');

