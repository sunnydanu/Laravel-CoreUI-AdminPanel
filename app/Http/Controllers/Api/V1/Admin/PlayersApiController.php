<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Player;

class PlayersApiController extends Controller
{
    public function index()
    {
        $players = Player::all();

        return $players;
    }

    public function store(StorePlayerRequest $request)
    {
        return Player::create($request->all());
    }

    public function update(UpdatePlayerRequest $request, Player $player)
    {
        return $player->update($request->all());
    }

    public function show(Player $player)
    {
        return $player;
    }

    public function destroy(Player $player)
    {
        return $player->delete();
    }
}
