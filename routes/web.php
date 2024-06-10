<?php

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
    return view('welcome');
});

Route::get('index', function(){
    return view('index');
})->name('index');
Route::get('event', function(){
    return view('event');
})->name('event');
Route::get('contact', function(){
    return view('contact');
})->name('contact');
Route::get('about', function(){
    return view('about');
})->name('about');