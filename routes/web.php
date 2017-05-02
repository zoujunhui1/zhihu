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

Route::get('/','QuestionsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('email/verify/{token}',['as'=>'email.verify','uses'=>'EmailController@verify']);

Route::resource('questions','QuestionsController',['name'=>[
    'create'=>'question.create',
    'show'=>'question.show',
]]);

Route::post('questions/{question}/answer','AnswersController@store');

Route::get('question/{question}/follow','QuestionFollowController@follow');
