<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HashtagController;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/profileanalyze', [ProfileController::class, 'profileanalyze'])->name('profileanalyze');
Route::get('/profileanalyze', [ProfileController::class, 'profileanalyze'])->name('profileanalyze');
Route::post('/hashtaganalyze', [HashtagController::class, 'hashtaganalyze'])->name('hashtaganalyze');
Route::get('/hashtaganalyze', [HashtagController::class, 'hashtaganalyze'])->name('hashtaganalyze');