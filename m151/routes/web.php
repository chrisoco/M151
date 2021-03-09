<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resources([

        'answer'    => 'AnswerController',
        'categorie' => 'CategorieController',
        'highscore' => 'HighscoreController',
        'question'  => 'QuestionController',

    ]);

Route::get('cat/select', 'CategorieController@selectCat')->name('categorie.select');


Route::group(['middleware' => 'auth'], function() {

});
