<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/profileanalyze', [ProfileController::class, 'profileanalyze'])->name('profileanalyze');