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

Route::get('cvs', 'CvController@index');
Route::get('cvs/create', 'CvController@create');
Route::post('cvs', 'CvController@store');
Route::get('cvs/{id}/edit', 'CvController@edit');
Route::put('cvs/{id}', 'CvController@update');
Route::delete('cvs/{id}', 'CvController@destroy');
Route::get('cvs/{id}/show', 'CvController@show');

Route::get('/getData/{id}', 'CvController@getData');

Route::post('/addExperience', 'ExperienceController@addExperience');
Route::put('/updateExperience', 'ExperienceController@updateExperience');
Route::delete('/deleteExperience/{id}', 'ExperienceController@deleteExperience');

Route::post('/addFormation', 'FormationController@addFormation');
Route::put('/updateFormation', 'FormationController@updateFormation');
Route::delete('/deleteFormation/{id}', 'FormationController@deleteFormation');


Route::post('/addProject', 'ProjectController@addProject');
Route::put('/updateProject', 'ProjectController@updateProject');
Route::delete('/deleteProject/{id}', 'ProjectController@deleteProject');

Route::post('/addSkill', 'SkillController@addSkill');
Route::put('/updateSkill', 'SkillController@updateSkill');
Route::delete('/deleteSkill/{id}', 'SkillController@deleteSkill');

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::resource('todos','TodoController');