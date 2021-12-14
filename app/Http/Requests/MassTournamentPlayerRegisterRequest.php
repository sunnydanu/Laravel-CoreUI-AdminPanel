<?php

namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassTournamentPlayerRegisterRequest extends FormRequest{
    public function authorize(){
        return abort_if(Gate::denies('register_tournament_player'), 403, '403 Forbidden') ?? TRUE;
    }

    public function rules(){
        return [
            'playerForms'                 => 'required|array',
            'playerForms.*.player_id'     => 'required|exists:players,id',
            'playerForms.*.tournament_id' => 'required|exists:tournaments,id',
            'playerForms.*.category_id'   => 'required|exists:categories,id',
            'playerForms.*.user_id'       => 'required|exists:users,id',

        ];
    }
}
