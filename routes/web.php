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

Route::get('/', [
    'uses' => 'TodosController@index',
    'as' => 'todos.index'
]);

Route::delete('/delete/{todo}', [
    'uses' => 'TodosController@destroy',
    'as' => 'todos.delete'
]);

Route::put('/update/{todo}', [
    'uses' => 'TodosController@update',
    'as' => 'todos.update'
]);

Route::get('/edit/{todo}', [
    'uses' => 'TodosController@edit',
    'as' => 'todos.edit'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
