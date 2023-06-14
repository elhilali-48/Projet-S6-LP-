<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmationRequest extends FormRequest
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
            'apogee' => "required|max:8|min:8",
            'date' =>'required',
            
        ];
    }
    public function messages()
    {   
        return[
           
            'apogee.required' => 'Ce Champ est obligatoire !',
            'apogee.max'=> "Le code Apogee se compose de 8 chiffres",
            'apogee.min'=> "Le code Apogee se compose de 8 chiffres",
           
            'date.required' => 'Ce Champ est obligatoire !'
        ];

    }
}
