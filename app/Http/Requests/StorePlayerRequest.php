<?php

namespace App\Http\Requests;

// use App\Player;
use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest{
    // public function authorize()
    // {
    //     return \Gate::allows('player_create');
    // }

    public function rules(){
        return [
            '*' => 'required',
        ];
    }
}
