<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    public function etudiants(){
        return $this->belongsToMany('App\Etudiant','semestre__etudiants','etudiant_id','semestre_id');
    }
}
