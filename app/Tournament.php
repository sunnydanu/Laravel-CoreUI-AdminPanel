<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $players
 */
class Tournament extends Model{
    use SoftDeletes;
    // use Uuid;

    protected $table = 'tournaments';
    public $incrementing = FALSE;
    protected $keyType = 'uuid';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function players(){
        return $this->belongsToMany(Player::class, TournamentPlayer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function draws(){
        return $this->hasMany(TournamentDraw::class);
    }
}
