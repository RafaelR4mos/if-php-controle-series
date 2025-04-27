<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/tasks');
    }

    return view('auth.login');
});

Auth::routes();


Route::middleware(['auth'])->controller(TasksController::class)->group(function () {
    Route::get('tasks', 'index')->name('tasks.index');
    Route::get('/tasks/create', 'create')->name('tasks.create');
    Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');
    Route::get('tasks/{task}', 'show')->name('tasks.show');

    Route::post('tasks/create', 'store')->name('tasks.store');

    Route::put('tasks/{task}', 'update')->name('tasks.update');

    Route::delete('tasks/{task}', 'destroy')->name('task.destroy');

    Route::patch('/tasks/{task}/complete', 'complete')->name('tasks.complete');
});
