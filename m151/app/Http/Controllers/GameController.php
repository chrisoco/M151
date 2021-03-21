<?php

namespace App\Http\Controllers;



use App\Models\Category;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
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

        $cat = Category::find(session('cat'));

        return view('game.index', [
            'cat' => $cat,
            'q' => $cat->questions->whereNotIn('id', [1,2])->get(),
        ]);

    }

}
