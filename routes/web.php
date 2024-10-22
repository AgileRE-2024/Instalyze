<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstagramController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/analyze', [InstagramController::class, 'analyze'])->name('analyze');