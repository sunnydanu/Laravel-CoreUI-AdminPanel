<?php

namespace App\Http\Requests;

use App\Player;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyPlayerRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('player_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:players,id',
        ];
    }
}
