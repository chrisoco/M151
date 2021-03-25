<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'catID'    => ['required'],
            'question' => ['required'],
        ], [
            'required' => 'x',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->getData();

        $cat = Category::find($data['catID']);

        $qValues = array();
        foreach($cat->questions as $q) {
            array_push($qValues, strtolower($q->value));
        }

        if(in_array(strtolower($data['question']), $qValues)) {
            $validator->getMessageBag()->add("question", "This Question already exists.");
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        Question::create([
            'value'         => $data['question'],
            'categories_id' => $data['catID'],
        ]);

        return redirect()->route('models_index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('models.question.edit', [
            'q' => Question::find($id),
        ]);
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
        $validator = Validator::make($request->all(), [
            'value'          => ['required'],
            'correct_answer' => [''],
        ], [
            'required' => 'x',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $q    = Question::find($id);
        $data = $validator->getData();

        $q->fill($data)->save();

        return redirect()->route('models_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('models_index');
    }
}
