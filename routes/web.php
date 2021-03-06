<?php

//This is an event that is fired automatically when a Proejct is created
// App\Project::created(function($project){
//     App\Activity::create([
//         'project_id'=> $project->id,
//         'description'=> 'created'
//     ]);
// });

// function gravatar_url($email)
// {
//     $email = md5($email);

//     return "http://gravatar.com/avatar/{$email}?s=60";
// }
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

Route::group(['middleware'=> 'auth'], function () {

    // Route::get('/projects', 'ProjectsController@index');
    // Route::get('/projects/create', 'ProjectsController@create');
    // Route::get('/projects/{project}', 'ProjectsController@show');
    // Route::get('/projects/{project}/edit', 'ProjectsController@edit');
    // Route::post('/projects', 'ProjectsController@store');
    // Route::patch('/projects/{project}', 'ProjectsController@update');
    // Route::delete('/projects/{project}', 'ProjectsController@destroy');

    Route::resource('/projects', 'ProjectsController');

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
    Route::delete('/projects/{project}/tasks/{task}', 'ProjectTasksController@delete');

    Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
