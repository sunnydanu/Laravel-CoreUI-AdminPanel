<?php

namespace App\Http\Requests;

use App\Tournament;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTournamentRequest extends FormRequest{
    public function authorize(){
        return \Gate::allows('tournament_edit');
    }

    public function rules(){
        return [
            'title' => [
                'required',
            ],
        ];
    }
}
