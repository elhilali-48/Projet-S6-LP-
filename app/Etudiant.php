<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etudiant extends Model
{
    use SoftDeletes;
    protected $fillable =["Nom","Prenom","Section",'Apogee','CNE',"CIN",'date_naissance','email','filiere_id'];
    // un etudiant étudie dans une seule filiére 
    public function filieres(){
        return $this->belongsTo('App\Filiere');
    }
    public function semestres(){
        return $this->belongsToMany('App\Semestre','semestre__etudiants','etudiant_id','semestre_id');
    }
    public function isConfirmed(){
        return $this->Etat == 0;
    }
    public function has_semestre($semestre){
        return in_array($semestre, $this->semestres->pluck('id')->toArray());
    }
    public function examen_villes(){
        return $this->belongsTo('App\ExamenVille');
    }
}
