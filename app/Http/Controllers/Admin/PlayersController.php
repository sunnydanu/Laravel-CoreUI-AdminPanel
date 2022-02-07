<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlayerRequest;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Player;
use App\Tournament;

class PlayersController extends Controller{
    public function index(){
        abort_unless(\Gate::allows('player_access'), 403);
        $tournament = new Tournament();
        $tournamentId = request('tournament', FALSE);
        $playersInTournament = $category_list = [];

        $players = Player::when(auth()->user()->hasRole('district'), function($q) use ($tournamentId){
            $q->where('players.district', auth()->user()->district)->when($tournamentId, function($q2){
                $q2->where('players.district_approval', '1')->where('players.state_approval', '1');
            });
        })->get();

        if($tournamentId){
            $playersInTournament = Player::when($tournamentId, function($q) use ($tournamentId){
                $q->whereHas('tournaments', function($q) use ($tournamentId){
                    $q->where('tournaments.id', $tournamentId);
                });
            })->when(auth()->user()->hasRole('district'), function($q){
                $q->where('players.district', auth()->user()->district);
            })->get();

            $tournament = Tournament::find($tournamentId);

            $category_list = Category::all();
        }

        return view('admin.players.index', compact('tournament', 'players', 'playersInTournament', 'category_list'));
    }

    public function create(){
        abort_unless(\Gate::allows('player_create'), 403);

        return view('admin.players.create');
    }

    public function store(StorePlayerRequest $request){
        abort_unless(\Gate::allows('player_create'), 403);

        $player = Player::create($request->all());

        return redirect()->route('admin.players.index');
    }

    public function edit(Player $player){
        abort_unless(\Gate::allows('player_edit'), 403);
        $category_list = Category::all();
        return view('admin.players.edit', compact('player', 'category_list'));
    }

    public function update(UpdatePlayerRequest $request, Player $player){
        abort_unless(\Gate::allows('player_edit'), 403);

        $player->update($request->all());

        return redirect()->route('admin.players.index');
    }

    public function approval($id){
        abort_unless(\Gate::allows('player_edit'), 403);
        $player = Player::findOrFail($id);
        $update = [];
        if(auth()->user()->hasRole('district')){
            $update['district_approval'] = 1;
        }
        if(auth()->user()->hasRole('state')){
            $update['state_approval'] = 1;
        }

        $player->update($update);

        return response()->json(['success' => 1], 200);
    }

    public function isPaid($id){
        abort_unless(\Gate::allows('player_edit'), 403);
        $player = Player::findOrFail($id);
        $update = [];
        $resp = ['success' => 0];

        $player->is_paid = (int)!$player->is_paid;

        if($player->save()){
            $resp = ['success' => 1];
        }

        return response()->json($resp, 200);
    }

    public function show(Player $player){
        abort_unless(\Gate::allows('player_show'), 403);

        return view('admin.players.show', compact('player'));
    }

    public function destroy(Player $player){
        abort_unless(\Gate::allows('player_delete'), 403);

        $player->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlayerRequest $request){
        Player::whereIn('id', request('ids'))->delete();

        return response(NULL, 204);
    }
}
