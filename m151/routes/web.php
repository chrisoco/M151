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

Route::get('/', function () { return view('index');})->name('index');


Route::get ('cat/select'   , 'CategoryController@selectCat')->name('start_play');
Route::get ('cat/set/{id}' , 'SessionController@setCat'    )->name('start_play.cat');
Route::get ('play'         , 'GameController@index'        )->name('play');
Route::post('play/answer'  , 'GameController@answer'       )->name('play.answer');
Route::get ('highscores'   , 'HighscoreController@index'   )->name('highscores.index');
Route::get ('joker'        , 'GameController@joker'        )->name('joker');
Route::get ('next/{id}'    , 'GameController@endQuestion'  )->name('play.next');

Route::post('setPlayerName'  , 'SessionController@setPlayerName'     )->name('playername.set');
Route::get ('session/destroy', 'SessionController@destroyGameSession')->name('session.destroy');


Route::group(['middleware' => 'auth'], function() {

    Route::get('models/edit', 'CategoryController@index')->name('models_index');
    Route::get('cat/restore/{id}', 'CategoryController@restore')->name('category.restore');

    Route::resources([
        'answer'    => 'AnswerController',
        'category'  => 'CategoryController',
        'highscore' => 'HighscoreController',
        'question'  => 'QuestionController',
    ]);

});
