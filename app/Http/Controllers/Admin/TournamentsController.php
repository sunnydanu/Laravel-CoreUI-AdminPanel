<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTournamentRequest;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Tournament;
use Illuminate\Support\Str;

class TournamentsController extends Controller
{
    public function index()
    {

        abort_unless(\Gate::allows('tournament_access'), 403);

        $tournaments = Tournament::all();

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('tournament_create'), 403);

        return view('admin.tournaments.create');
    }

    public function store(StoreTournamentRequest $request)
    {
        abort_unless(\Gate::allows('tournament_create'), 403);
        $data = $request->all();
        $data['id'] = Str::random(9);
        $tournament = Tournament::create($data);

        return redirect()->route('admin.tournaments.index');
    }

    public function edit(Tournament $tournament)
    {
        abort_unless(\Gate::allows('tournament_edit'), 403);

        return view('admin.tournaments.edit', compact('tournament'));
    }

    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        abort_unless(\Gate::allows('tournament_edit'), 403);

        $tournament->update($request->all());

        return redirect()->route('admin.tournaments.index');
    }

    public function show(Tournament $tournament)
    {
        abort_unless(\Gate::allows('tournament_show'), 403);

        return view('admin.tournaments.show', compact('tournament'));
    }

    public function destroy(Tournament $tournament)
    {
        abort_unless(\Gate::allows('tournament_delete'), 403);

        $tournament->delete();

        return back();
    }

    public function massDestroy(MassDestroyTournamentRequest $request)
    {
        Tournament::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
