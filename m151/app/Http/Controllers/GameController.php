<?php

namespace App\Http\Controllers;



use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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

        // TODO: Save Question answered Correct / False
        if($q->c_answer->id == $a->id) {

            $q->answer_count = true;
            $validator->getMessageBag()->add('answer', 'c');
            $this->addPoints();

        } else {

            $q->answer_count = false;
            $validator->getMessageBag()->add('answer', $a->id);
            $this->quizFailed();

        }

        $this->completeQuestion($q->id);


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

    public function completeQuestion($id)
    {
        $completed = session('q_completed');
        array_push($completed, $id);

        // session(['q_completed' => $completed]);
        // session(['activeQID' => 0]);

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
