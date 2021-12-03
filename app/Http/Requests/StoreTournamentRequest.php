<?php

namespace App\Http\Requests;

// use App\Tournament;
use Illuminate\Foundation\Http\FormRequest;

class StoreTournamentRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return \Gate::allows('tournament_create');
    // }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
        ];
    }
}
