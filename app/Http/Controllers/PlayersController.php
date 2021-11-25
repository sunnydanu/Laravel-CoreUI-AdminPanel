<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePlayerRequest;


class PlayersController extends Controller
{

    public function create()
    {

        return view('admin.players.create');
    }

    public function store(StorePlayerRequest $request)
    {

        // dd($request->all());

        $data = $request->all();
        $data['id'] = Str::random(9);
        $data['player_img'] = Storage::disk('public_uploads')->putFile('/players', $request->file('player_image'));
        $data['dob_crt'] = Storage::disk('public_uploads')->putFile('/dob', $request->file('dob_crt'));

       // dd($data);
        $player = Player::create($data);


        return redirect()->route('player.register');
    }

}
