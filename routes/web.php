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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'UserController@index');

Route::get('/getData', 'UserController@usersList');
Route::get('/datatable', function()
{
    $model1 = DB::table('users')->where('status','=',2)->orderBy('status', 'DESC')->get();
    return view('datatable',['pendingData'=>$model1]);
});
Route::get('/user', 'UserController@getUser')->name('datatables.data');
Route::get('/jqueryvalidation', 'UserController@jqueryValidation');
Route::post('/registerUser', 'UserController@registerUser');
