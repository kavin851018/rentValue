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


//protytpe

Route::get('/index', function () {
    return view('prototype.index');
});

Route::get('/jquery',function(){
    return view('prototype.jquery');
});

Route::get('/upload',function(){
    return view('prototype.upload2');
});

//網址規劃

Route::get('/','HomeController@indexPage');

Route::group(['prefix'=>'user'],function(){
    Route::post('/user/evaluate','UserController@createValuation');
    Route::get('/user/upload','UserController@showUploadPage');
    Route::post('/user/upload','UserController@uploadObject');
});
