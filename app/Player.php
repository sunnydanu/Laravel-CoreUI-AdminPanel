<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;
    // use Uuid;

    protected $table = 'players';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $dates = [
        'created_at',
        'dob',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'full_name',
        'father_name',
        'mother_name',
        'gender',
        'dob',
        'category',
        'district',
        'address',
        'pincode',
        'phone',
        'shirt_size',
        'short_size',
        'tracksuite_size',
        'shoe_size',
        'player_img',
        'dob_crt',
        'district_approval',
        'state_approval',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
