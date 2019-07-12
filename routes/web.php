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

Auth::routes();

Route::get('/', 'FileController@getFiles')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('list/uploads', 'FileController@getFiles');
Route::get('fileupload', 'FileController@getFiles');
Route::get('sort_by_types/{file_type_name}', 'FileController@get_files_by_types');
Route::post('upload/files/to/server', 'FileController@addnew');