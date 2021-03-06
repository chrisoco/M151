<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{

    public function setPlayerName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'player_name' => ['required'],
        ], [
            'required' => 'Please enter a valid Username.',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        session(['player_name' => $validator->getData()['player_name']]);

        return redirect()->route('start_play');

    }

    public function setCat($id)
    {
        if(is_null(Category::find($id)) || Category::find($id)->not_valid) {
            return redirect(route('start_play'));
        }

        session(['cat' => $id]);
        $this->initGameSession();

        return redirect()->route('play');

    }

    public function initGameSession()
    {
        session([
            'q_completed' => array(),
            'points'      => 0,
            'started_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'joker'       => true,
            'activeQID'   => 0,
            'gameOver'    => false,
        ]);
    }

    public function destroyGameSession()
    {
        session()->forget([
            'player_name', 'cat', 'q_completed',
            'points', 'started_at', 'activeQID',
            'joker', 'jokerAnswers', 'errDisplayed',
            'gameOver'
        ]);

        return redirect()->route('index');

    }
}
