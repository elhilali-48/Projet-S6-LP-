<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    public function etudiants(){
        // une filiere contient plusieurs étudiant 
        return $this->hasMany('App\Etudiant', 'filiere_id');
    }
}
