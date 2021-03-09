<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setCat($id)
    {
        if(is_null(Category::find($id))) return redirect(route('start_play'));

        session(['cat' => $id, 't' => 'bluub']);
        ddd(session()->all());

    }

    public function initGameSession()
    {
        //
    }



}
