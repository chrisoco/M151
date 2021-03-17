<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // TODO: Correct doesn^t return value if checkbox is disabled ...
        $validator = Validator::make($request->all(), [
            'answer'  => ['required'],
            'qID'     => ['required'],
            'correct' => [''],
        ], [
            'required'   => 'x',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->getData();

        $a = Answer::create([
            'value' => $data['answer'],
        ]);

        $q = Question::find($data['qID']);

        $q->answers()->attach($a);

        if(array_key_exists('correct', $data) && $data['correct'] == 'on' && is_null($q->c_answer)) {
            $q->correct_answer = $a->id;
            $q->save();
        }

        return redirect()->route('models_index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $q = Question::find($answer->questions[0]->id);


        if(!is_null($q->c_answer) && $q->c_answer->id == $answer->id) {
            $q->correct_answer = null;
            $q->save();
        }

        //$q->answers()->detach($answer->id);
        $answer->questions()->detach($q->id);

        $answer->delete();

        return redirect()->route('models_index');
    }
}
