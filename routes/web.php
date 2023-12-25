<?php

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

Route::get('/', function () {
    return view('home');
});

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

Route::post('/submit-form', [DataController::class, 'storeData']);

Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'] ,function(){
    return view('home');
})->middleware('auth')->name('logout');

Route::get('/comment/{formData}', [CommentController::class, 'showComments'])->name('comment');

Route::post('/comment/store', [CommentController::class, 'storeComment'])->name('comment.store');

