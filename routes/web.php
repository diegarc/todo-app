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
Route::get('/tasks/starred', 'TaskController@starred');
Route::get('/tasks/project/{project}', 'TaskController@byProject');
Route::get('/tasks/create/starred', 'TaskController@createStarred');
Route::get('/tasks/create/{projectId?}', 'TaskController@create');
Route::delete('/tasks/done/{task}', 'TaskController@done');
Route::resource('tasks', 'TaskController');
Route::resource('projects', 'ProjectController');
