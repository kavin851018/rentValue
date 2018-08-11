<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('prototype.index');
});

Route::get('/jquery',function(){
    return view('prototype.jquery');
});

Route::get('/upload',function(){
    return view('prototype.upload2');
});