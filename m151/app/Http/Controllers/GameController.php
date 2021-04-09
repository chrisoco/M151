<?php

namespace App\Http\Controllers;



use App\Models\Answer;
use App\Models\Category;
use App\Models\Highscore;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GameController extends Controller
{

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


        $questions = Question::all()->where('categories_id', session('cat'))->whereNotIn('id', session('q_completed'));


        if(session('activeQID') == 0) {

            session()->forget('errDisplayed');

            if($questions->isEmpty()) { return redirect()->route('play.end'); }

            $question  = $questions->random();
            session(['activeQID' => $question->id]);


        } else {

            if(array_key_exists('errDisplayed', session()->all()) && session('errDisplayed')) {

                if(array_key_exists('gameOver', session()->all()) && session('gameOver')) {
                    return redirect()->route('play.over');
                }

                session()->forget('errDisplayed');

                if($questions->isEmpty()) { return redirect()->route('play.end'); }

                $question = $questions->random();
                session(['activeQID' => $question->id]);

            } else {

                $question  = Question::find(session('activeQID'));

            }

        }

        return view('game.index', [
            'q'       => $question,
            'q_count' => count($questions),
        ]);

    }

    public function answer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => ['required'],
            'answer_id'   => ['required'],
        ], [
            'required' => 'Please enter a valid Username.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('play');
        }

        $data = $validator->getData();

        $q = Question::find($data['question_id']);
        $a = Answer::find($data['answer_id']);


        if($q->c_answer->id == $a->id) {

            $validator->getMessageBag()->add('answer', 'c');

            $q->answer_count = true;
            $this->addPoints();

        } else {

            $validator->getMessageBag()->add('answer', $a->id);

            $q->answer_count = false;
            $this->quizFailed();

        }


        $completed = session('q_completed');
        array_push($completed, $q->id);

        session(['q_completed' => $completed]);

        return redirect(url()->previous())->withErrors($validator);

    }

    public function quizFailed()
    {
        session(['points' => 0]);
    }

    public function addPoints()
    {
        $points = session('points');
        $points += 30;
        session(['points' => $points]);
    }

    public function endQuestion($id)
    {
        $completed = session('q_completed');

        if(in_array($id, $completed)) {
            session(['activeQID' => 0]);
        }

        return redirect()->route('play');

    }

    public function joker()
    {
        $validator = Validator::make(session()->all(), [
            'joker'     => ['required'],
            'activeQID' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous());
        }

        if(session('joker')) {

            session(['joker' => false]);

            $q = Question::find(session('activeQID'));

            $a1 = Answer::all()->where('question_id', $q->id)->whereNotIn('id', $q->c_answer->id)->random();
            $a2 = Answer::all()->where('question_id', $q->id)->whereNotIn('id', [$q->c_answer->id, $a1->id])->random();

            session(['jokerAnswers' => [$a1->id, $a2->id]]);

        }

        return redirect(url()->previous());

    }

    public function over()
    {
        $h = $this->createHighscore();

        if($h) return view('game.over');

        return redirect()->route('highscores.index');
    }

    public function end()
    {
        $h = $this->createHighscore();

        if($h) return view('game.end', ['h' => $h]);

        return redirect()->route('highscores.index');
    }

    public function createHighscore()
    {
        $validator = Validator::make(session()->all(), [
            'started_at'  => ['required'],
            'player_name' => ['required'],
            'cat'         => ['required'],
            'points'      => ['required'],
        ]);

        if ($validator->fails()) { return false;}

        $h = Highscore::create([
            'started_at'     => session('started_at'),
            'player_name'    => session('player_name'),
            'categories_id'  => session('cat'),
            'points'         => session('points'),
            'points_s'       => 0,
        ]);

        if($h->points > 0) {
            $created = Carbon::parse($h->created_at);
            $started = Carbon::parse($h->started_at);
            $diff = $created->diffInSeconds($started);

            $h->points_s = round($h->points / $diff, 2);
            $h->started_at = $started;
            $h->save();
        }

        session()->forget([
            'cat', 'q_completed', 'points', 'started_at',
            'activeQID', 'joker', 'jokerAnswers',
            'errDisplayed', 'gameOver',
        ]);

        return $h;

    }

}
