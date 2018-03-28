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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'TaskController@index');

    Route::prefix('tasks')->group(function () {
        Route::get('/starred', 'TaskController@starred');
        Route::get('/project/{project}', 'TaskController@byProject');
        Route::get('/create/starred', 'TaskController@createStarred');
        Route::get('/create/{projectId?}', 'TaskController@create');
        Route::post('/starred/{task}', 'TaskController@toggleStarred');
        Route::delete('/done/{task}', 'TaskController@done');
        Route::post('/undone/{taskId}', 'TaskController@undone');
    });

    Route::resource('tasks', 'TaskController');
    Route::resource('projects', 'ProjectController');
});