<?php

namespace App;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Model;

class TournamentDraw extends Model{
    use UuidForKey;
    protected $fillable = [

        'tournament_id',
        'gender',
        'category_id',
        'name',
        'size',
        'bracket',
        'status',
        'result',

    ];
    protected $casts = [
        'bracket' => 'object',
    ];
    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',

    ];

    //

    function tournaments(){
        $this->belongsTo(Tournament::class);
    }
}
