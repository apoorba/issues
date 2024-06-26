<?php

use App\Http\Controllers\ApoorbaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('home');
});

Route::get('/', function () {
    return view('welcome');
});

Route::post('/submitForm', [DataController::class, 'storeData']);

Route::get('/comment', function () {
    return view('comment');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', [DataController::class, 'showData']);



Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'] ,function(){
    return view('home');
})->middleware('auth')->name('logout');

Route::get('/comment/{formData}', [CommentController::class, 'showComments'])->name('comment');

Route::post('/comment/store', [CommentController::class, 'storeComment'])->name('comment.store');

Route::put('/comment/{id}/accept', [CommentController::class, 'acceptIssue'])->name('comment.accept')->middleware('auth');

Route::put('/comment/{id}/solve', [CommentController::class, 'solveIssue'])->name('comment.solve');

//Route::post('/dashboard', [DataController::class, 'search'])->name('search');

//Route::get('/apoorba', [ApoorbaController::class, 'view']);
