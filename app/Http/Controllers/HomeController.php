<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		\JavaScript::put([
		    'Author' => 'AmirHome.com'
		]);
        return view('home');
    }
}
