<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        return view('home');
    }
}
