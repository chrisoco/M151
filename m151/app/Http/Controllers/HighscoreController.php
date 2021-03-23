<?php

namespace App\Http\Controllers;

use App\Models\Highscore;
use Illuminate\Http\Request;

class HighscoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('highscore.index', [
            'list' => Highscore::all()->where('points', '>', 0)->sortByDesc('points_s'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Highscore $highscore
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Highscore $highscore)
    {
        $highscore->delete();
        return redirect()->route('highscores.index');
    }
}
