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
use App\TournamentDraw;
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

        $tournament = Tournament::find($tournamentId);

        $playersInTournament = Player::when($tournamentId, function($q) use ($tournamentId){
            $q->whereHas('tournaments', function($q) use ($tournamentId){
                $q->where('tournaments.id', $tournamentId);
            });
        })->get();

        return view('admin.tournaments.draw', compact('playersInTournament', 'tournament'));
    }

    public function renderDraw(){
        $draw = collect();
        $category_list = Category::all();

        if(request()->has('drawId')){
            $drawDetail = TournamentDraw::find(request('drawId'));
            $draw->put('detail', $drawDetail);
            $draw->put('size', $drawDetail->size);
            $draw->put('tournament', $drawDetail->tournament_id);
            $draw->put('action', 'view');
        }else{
            $draw->put('action', 'create');
            $draw->put('size', request('size'));
            $draw->put('tournament', request('tournament'));
        }

        return view("draws.index", compact('category_list', 'draw'));
    }

    public function storeDraw(){
        $response = ['status' => '0'];

        try{
            $tournament = [];
            $data = request()->except(['_token']);
            if(request('action') == 'create'){
                $data['status'] = 1;
                $data['result'] = 'TBA';
                $tournament = TournamentDraw::create($data);
            }
            if(request('action') == 'view'){
                $tournament = TournamentDraw::find($data['drawId']);

                $tournament->bracket = $data['bracket'];
                $tournament->name = $data['name'];
                $tournament->gender = $data['gender'];
                $tournament->category_id = $data['category_id'];
                $tournament->save();
            }

            $response = ['status' => '1', 'tournamentId' => $tournament->id];
        }catch(\Exception $exception){
            $response['error'] = $exception->getMessage();
        }

        return response()->json($response, 201);
    }

    public function create(){
        abort_unless(\Gate::allows('tournament_create'), 403);

        $district_list = District::all();

        return view('admin.tournaments.create', compact('district_list'));
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
