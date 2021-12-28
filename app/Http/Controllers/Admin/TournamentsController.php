<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTournamentRequest;
use App\Http\Requests\MassTournamentPlayerRegisterRequest;
use App\Http\Requests\RemovePlayerFromTournamentRequest;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Player;
use App\Tournament;
use App\TournamentPlayer;
use Illuminate\Support\Str;

class TournamentsController extends Controller{
    public function index(){
        abort_unless(\Gate::allows('tournament_access'), 403);

        $tournaments = Tournament::all();

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function draw(){
        abort_unless(\Gate::allows('player_access'), 403);

        $players = Player::all();

        $tournamentId = request('tournament', FALSE);

        $playersInTournament = Player::when($tournamentId, function($q) use ($tournamentId){
            $q->whereHas('tournaments', function($q) use ($tournamentId){
                $q->where('tournaments.id', $tournamentId);
            });
        })->get();

        return view('admin.tournaments.draw', compact('playersInTournament'));
    }

    public function renderDraw(){
        $category_list = Category::all();
        return view("draws.index", compact('category_list'));
    }

    public function storeDraw(){
        dd(request()->all());
    }

    public function create(){
        abort_unless(\Gate::allows('tournament_create'), 403);

        $district_list = District::all();
        //        $category_list = Category::all();
        return view('admin.tournaments.create', compact('district_list', 'category_list'));
    }

    public function store(StoreTournamentRequest $request){
        abort_unless(\Gate::allows('tournament_create'), 403);
        $data = $request->all();
        $data['id'] = Str::random(9);
        $tournament = Tournament::create($data);

        return redirect()->route('admin.tournaments.index');
    }

    public function edit(Tournament $tournament){
        abort_unless(\Gate::allows('tournament_edit'), 403);

        return view('admin.tournaments.edit', compact('tournament'));
    }

    public function update(UpdateTournamentRequest $request, Tournament $tournament){
        abort_unless(\Gate::allows('tournament_edit'), 403);

        $tournament->update($request->all());

        return redirect()->route('admin.tournaments.index');
    }

    public function show(Tournament $tournament){
        abort_unless(\Gate::allows('tournament_show'), 403);

        return view('admin.tournaments.show', compact('tournament'));
    }

    public function destroy(Tournament $tournament){
        abort_unless(\Gate::allows('tournament_delete'), 403);

        $tournament->delete();

        return back();
    }

    public function massDestroy(MassDestroyTournamentRequest $request){
        Tournament::whereIn('id', request('ids'))->delete();

        return response(NULL, 204);
    }

    public function registerPlayer(MassTournamentPlayerRegisterRequest $request){
        TournamentPlayer::insert($request['playerForms']);
        return response(NULL, 204);
    }

    public function removePlayer(RemovePlayerFromTournamentRequest $request){
        TournamentPlayer::whereIn('id', request('ids'))->delete();
        return response(NULL, 204);
    }
}
