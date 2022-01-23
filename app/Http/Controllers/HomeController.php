<?php

namespace App\Http\Controllers;

use App\Category;
use App\Player;
use App\Tournament;
use App\TournamentDraw;
use Illuminate\Http\Request;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       // $this->middleware('auth');
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

    public function tournaments(){
        $tournaments = Tournament::all();

        return view('home.tournaments.index', compact('tournaments'));
    }

    public function draw(){
        $players = Player::all();

        $tournamentId = request('tournament', FALSE);

        $tournament = Tournament::find($tournamentId);

        $playersInTournament = Player::when($tournamentId, function($q) use ($tournamentId){
            $q->whereHas('tournaments', function($q) use ($tournamentId){
                $q->where('tournaments.id', $tournamentId);
            });
        })->get();

        return view('home.tournaments.draw', compact('playersInTournament', 'tournament'));
    }
}
