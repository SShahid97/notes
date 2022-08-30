<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CommentController;
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

Route::get('/',[NoteController::class, 'index']);
Route::resource('notes', NoteController::class);
Route::resource('comments', CommentController::class);
Route::get('notes/commentupdate/{id}/{noteid}', [CommentController::class, 'change']);


