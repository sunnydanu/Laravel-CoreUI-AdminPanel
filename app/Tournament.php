<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use SoftDeletes;
    // use Uuid;

    protected $table = 'tournaments';
    public $incrementing = false;
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

}
