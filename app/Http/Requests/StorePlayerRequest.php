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
            'full_name'    => 'required',
            'father_name'  => 'required',
            'mother_name'  => 'required',
            'gender'       => 'required',
            'dob'          => 'required',
            'category'     => 'required',
            'district'     => 'required',
            'address'      => 'required',
            'pincode'      => 'required',
            'phone'        => 'required',
            'email'        => 'required',
            'player_image' => 'required',
            'dob_crt'      => 'required',
        ];
    }
}
