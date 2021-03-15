<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
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
        if(is_null(Category::find($id))) return redirect(route('start_play'));

        // session(['cat' => $id, 't' => 'bluub']);
        session(['cat' => $id]);
        ddd(session()->all());

    }

    public function initGameSession()
    {
        //
    }

    public function destroyGameSession()
    {
        session()->forget('player_name');
        session()->forget('cat');

        return redirect()->route('index');

    }



}
