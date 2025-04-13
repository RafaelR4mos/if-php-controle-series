<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::check()) {
        return redirect('series');
    }

    return view('auth.login');
});

Auth::routes();

Route::get('/series', [App\Http\Controllers\SeriesController::class, 'index'])->name('series');
