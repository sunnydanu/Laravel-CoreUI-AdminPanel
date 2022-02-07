<?php

namespace App\Http\Controllers;

use App\Category;
use App\District;
use App\Player;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePlayerRequest;

class PlayersController extends Controller{
    public function create(){
        $district_list = District::all();
        $category_list = Category::all();
        return view('admin.players.create', compact('district_list', 'category_list'));
    }

    public function store(StorePlayerRequest $request){
        // dd($request->all());

        $data = $request->all();

        $data['player_img'] = Storage::disk('public_uploads')->putFile('/players', $request->file('player_image'));
        $data['dob_crt'] = Storage::disk('public_uploads')->putFile('/dob', $request->file('dob_crt'));
        Player::create($data);
        return redirect()->route('player.register');
    }
}
