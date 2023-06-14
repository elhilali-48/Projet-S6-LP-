<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mdp_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mdp_an'=>'required',
            'mdp_nv'=>'required',
            'confirm'=>'required|same:mdp_nv',
        ];
    }

    public function messages()
    {   
        return[
            'mdp_an.required' =>'Ce champ est obligatoire',
            'mdp_nv.required' =>'Ce champ est obligatoire',
            'confirm.required' =>'Ce champ est obligatoire',
            'confirm.same' =>'les deux mots de passe ne correspond pas',
        ];

    }
}
