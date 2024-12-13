<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'processSignup']);
Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin');
Route::post('/signin', [AuthController::class, 'processSignin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Halaman History
Route::get('/history', [ProfileController::class, 'showProfileHistory'])->name('history');
Route::get('/hashtaghistory', [HashtagController::class, 'showHashtagHistory'])->name('hashtaghistory');
Route::get('/headlinehistory', [HeadlineController::class, 'showHeadlineHistory'])->name('headlinehistory');

Route::get('/profile/{username}', [ProfileController::class, 'profileanalyze'])->name('profile');

Route::get('/profilenotfound', function () {
    return view('profilenotfound');
})->name('profilenotfound');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('/profileanalyze', [ProfileController::class, 'profileanalyze'])->name('profileanalyze');
Route::get('/profileanalyze', [ProfileController::class, 'profileanalyze'])->name('profileanalyze');
Route::post('/hashtaganalyze', [HashtagController::class, 'hashtaganalyze'])->name('hashtaganalyze');
Route::get('/hashtaganalyze', [HashtagController::class, 'hashtaganalyze'])->name('hashtaganalyze');
Route::post('/headlineanalyze', [HeadlineController::class, 'headlineanalyze'])->name('headlineanalyze');
Route::get('/headlineanalyze', [HeadlineController::class, 'headlineanalyze'])->name('headlineanalyze');

// Route::get('/headlineanalyze', [HeadlineController::class, 'showHeadline'])->name('headlineanalyze');