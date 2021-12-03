<?php

namespace App\Http\Requests;

use App\Tournament;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyTournamentRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('tournament_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tournaments,id',
        ];
    }
}
