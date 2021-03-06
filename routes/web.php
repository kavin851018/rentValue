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

Route::get('/uploadTest',function(){

    return view('up');
});




//網址規劃

Route::get('/','HomeController@indexPage');
Route::post('/sendValue','HomeController@sendValue');

Route::group(['prefix'=>'user'],function(){
    Route::post('/evaluate','UserController@createValuation');
    Route::get('/upload','UserController@showUploadPage');
    Route::post('/upload','UserController@uploadObject');
    Route::get('/auth/sign-in','UserController@signInPage');
    Route::post('/auth/sign-in','UserController@signInProcess');
    Route::get('/auth/sign-out','UserController@signOut');
    Route::get('/auth/sign-up','UserController@signUpPage');
    Route::post('/auth/sign-up','UserController@signUpProcess');
    Route::get('/manage','UserController@manageObject')->middleware(['user.auth.admin']);
	Route::delete('/manage/delete','UserController@deleteObject')->middleware(['user.auth.admin']);
});

Route::get('/getIP','UserController@getIP');
Route::get('/index/search','HomeController@searchPage');