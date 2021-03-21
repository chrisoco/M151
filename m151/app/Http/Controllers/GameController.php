<?php

namespace App\Http\Controllers;



use App\Models\Category;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validator = Validator::make(session()->all(), [
            'player_name' => ['required'],
            'cat'         => ['required'],
        ], [
            'required' => 'Please enter a valid Username.',
        ]);

        if($validator->errors()->get('player_name')) {
            return redirect()->route('index')->withErrors($validator);
        } else
        if($validator->errors()->get('cat')) {
            return redirect()->route('start_play')->withErrors($validator);
        }


        if(session('activeQID') == 0) {
            $question = Question::all()->where('categories_id', session('cat'))->whereNotIn('id', session('q_completed'))->random();
            session(['activeQID' => $question->id]);
        } else {
            $question = Question::find(session('activeQID'));
        }

        return view('game.index', [
            'q'   => $question,
        ]);

    }

    public function joker()
    {

        $question = Question::find(session('activeQID'));
        session(['joker' => false]);


        redirect()->route('play', [
           'wrong_answers' => [],
        ]);
    }

}
