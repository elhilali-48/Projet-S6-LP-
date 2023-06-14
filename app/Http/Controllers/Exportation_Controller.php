<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use App\Filiere;
use App\Section;
use App\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Exportation_Controller extends Controller
{
    public function export(Filiere  $filiere){
        $filiere = Filiere::all();
        $semestre = Semestre::all();
        
        return view("export.index",['filiere'=>$filiere],['semestre'=>$semestre]);
    }
    public function export_all(Request $request){
       
        if($request->has('filiere')){
            $filiere = $request->filiere;
            $confirm = $request->confirm;
            $semestre = $request->semestre;
            $section = $request->section;
            // $etudiant= DB::table('etudiants')
            // ->where([['semestre_id','=',$semestre],['Section','=',$section],['filiere_id','=',"$filiere"]])
            // ->join('filieres','filiere_id','=','filieres.id')
            // ->whereIn('filiere_id',[$filiere])
            // ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
            // ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
            // ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
            // ->where('Section','=',$section)
            // ->whereIn('filiere_id',[$filiere])
            // ->where([['semestre_id','=',$semestre],['Section','=',$section],['filiere_id','=',"$filiere"]])
            // ->where('Etat',$confirm)
            // ->get();
            
            $etudiant = DB::table('etudiants')
           
            ->join('filieres','filiere_id','=','filieres.id')
            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
            ->where('Etat','LIKE','%'.$confirm.'%')
            ->whereIn('filiere_id',[$filiere])
            ->where('Section','LIKE','%'.$section.'%')
            ->where('semestre','LIKE','%'.$semestre.'%')
            ->get();

            $count = DB::table('etudiants')
           
            ->join('filieres','filiere_id','=','filieres.id')
            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
            ->where('Etat','like','%'.$confirm.'%')
            ->whereIn('filiere_id',[$filiere])
            ->where('Section','like','%'.$section.'%')
            ->where('semestre','like','%'.$semestre.'%')
            ->count();

            if($count>0){
                $pdf = PDF::loadView('export.eco',["economie"=>$etudiant],["count"=>$count])->setPaper('a4', 'portrait');;
                return $pdf->download(''.$etudiant->first()->filiere.'- '.$semestre.'-'.$section.'.pdf');
            }
            else{
                return \redirect()->back();
            }

          

        }
        

        
















     }
}
