<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Etudiant_Request extends FormRequest
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
            'nom'=>'required',
            'prenom'=>'required',
            'Apogee'=>"required|max:8|min:8",
            'CNE'=>"required",
            'CIN'=>"required",
            'date' =>'required',
            'email' =>'required',
            'filiere' =>'required',
            'semestre' =>'required',
            'section'=>'required'
        ];
    }
    public function messages()
    {   
        return[
           
            'Apogee.required' => 'Ce Champ est obligatoire !',
            'Apogee.max'=> "Le code Apogee se compose de 8 chiffres",
            'Apogee.min'=> "Le code Apogee se compose de 8 chiffres",
            'nom.required' => 'Ce Champ est obligatoire !',
            'prenom.required' => 'Ce Champ est obligatoire !',
            'CNE.required' => 'Ce Champ est obligatoire !',
            'CIN.required' => 'Ce Champ est obligatoire !',
            'email.required' => 'Ce Champ est obligatoire !',
            'filiere.required' => 'Ce Champ est obligatoire !',
            'semestre.required' => 'Ce Champ est obligatoire !',
            'section.required' => 'Ce Champ est obligatoire !',
            'date.required' => 'Ce Champ est obligatoire !'
        ];

    }
}
