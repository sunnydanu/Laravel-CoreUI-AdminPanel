<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class RemovePlayerFromTournamentRequest extends FormRequest{
    public function rules(){
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tournament_players,id',
        ];
    }
}
