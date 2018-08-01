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

Route::group(['prefix'=>'todo','middleware'=>'auth'],function(){
    
Route::get('/all','TodoController@index')->name('todo.all');
    
Route::get('/create','TodoController@create')->name('todo.create');    
    
Route::post('/add','TodoController@store')->name('todo.add');

Route::get('/edit/{id}','TodoController@edit')->name('todo.edit');
    
Route::post('/update/{id}','TodoController@update')->name('todo.update');
    
Route::get('/trash/{id}','TodoController@destroy')->name('todo.trash');
    
Route::get('/finished','TodoController@trash')->name('todo.finished');
    
Route::get('/kill/{id}','TodoController@kill')->name('todo.kill');

Route::get('/restore/{id}','TodoController@restore')->name('todo.restore');

});

Auth::routes();
Route::get('/home', 'TodoController@index')->name('home');
