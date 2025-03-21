<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','App\Http\Controllers\PagesController@index');

Route::get('/hello', function () {
    return '<h1>Hello world</h1>';
});

Route::get('/about','App\Http\Controllers\PagesController@about');

Route::get('/users/{id}', function ($id) {
    return 'This is a user: '.$id;
});

Route::get('/services','App\Http\Controllers\PagesController@services');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts','App\Http\Controllers\PostsController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
