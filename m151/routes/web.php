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



Route::get('cat/select'   , 'CategoryController@selectCat')->name('start_play');
Route::get('play/cat/{id}', 'Controller@setCat'           )->name('start_play.cat');
Route::get('highscores'   , 'HighscoreController@index'   )->name('highscores.index');
Route::post('setPlayerName', 'Controller@setPlayerName'   )->name('playername.set');


Route::group(['middleware' => 'auth'], function() {

    Route::resources([
        'answer'    => 'AnswerController',
        'category'  => 'CategoryController',
        'highscore' => 'HighscoreController',
        'question'  => 'QuestionController',
    ]);

});
