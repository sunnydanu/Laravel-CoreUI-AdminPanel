<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentPlayer extends Model{
    //
    function players(){
        $this->belongsTo(Player::class);
    }

    function tournaments(){
        $this->belongsTo(Tournament::class);
    }
}
