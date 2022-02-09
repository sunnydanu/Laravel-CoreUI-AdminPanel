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
    function player(){
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }

    function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    function tournament(){
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }
}
