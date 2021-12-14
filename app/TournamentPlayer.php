<?php

namespace App;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Model;

class TournamentPlayer extends Model{
    use UuidForKey;

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',

    ];
    //
    function players(){
        $this->belongsTo(Player::class);
    }

    function tournaments(){
        $this->belongsTo(Tournament::class);
    }
}
