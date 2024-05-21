<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/projects', function () {
    return view('projects');
});

Route::get('/', function () {
    return view('index');
});
Route::get('/resume', function () {
    return view('resume');
});
Route::get('/services', function () {
    return view('services');
});

Route::get('contact', [ContactController::class, 'index'])->name('contact.create');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');