<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamenVille extends Model
{
    public function etudiants(){
        return $this->hasMany('App\Etudiant','examen_ville_id');
    }
}
