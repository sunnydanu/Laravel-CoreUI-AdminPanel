<?php

namespace App\Http\Controllers;

use App\Category;
use App\TournamentDraw;
use Illuminate\Http\Request;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewDraw(){
        $draw = TournamentDraw::find(request('drawId'));

        return view("draws.view", compact('draw'));
    }
}
