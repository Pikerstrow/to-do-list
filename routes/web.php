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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/username', 'HomeController@getUsername')->middleware('auth');
Route::get('/tasks/get-tasks-quantity-by-month/{year}/{month}', 'TasksController@getTasksByMonth')->middleware('auth');
Route::get('/tasks/get-for-editing/{id}', 'TasksController@getTaskForEditing')->middleware('auth');
Route::resource('/tasks', 'TasksController')->middleware('auth');
Route::patch('/tasks/change-status/{id}', 'TasksController@updateStatus')->middleware('auth');


Route::get('/{vue_capture?}', function () {
    return view("admin");
})->where('vue_capture', '[\/\w\.-]*')->middleware('auth');
