<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Etudiant;
use App\ExamenVille;
use App\Http\Requests\ConfirmationRequest;
use App\Mail\Confirmaion_mail;
use App\Semestre;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class ConfirmationController extends Controller
{
    public function show(ConfirmationRequest $req ,Etudiant $etudiant){
        $etudiant = Etudiant::where('Apogee',  $req->apogee)->where('date_naissance',$req->date)->first();
        if(!$etudiant){
            session()->flash('error',"Aucun étudiant ne correspond à cet Apogee avec
            cette date de naissance !");
            return redirect()->back();
        }
        if($etudiant)
        {   
            $etudiant = DB::table('etudiants')
                ->join('filieres','filiere_id','=','filieres.id')
                ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                
                ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                ->where('Apogee',  $req->apogee)
                ->get();
            $id = $etudiant->first()->id;
            $ville =  ExamenVille::all();
            //  return view("confirmation.show",["etudiant"=>$etudiant,'ville'=>$ville]);
        //   return Redirect::action("confirmation",$req->apogee)->with(["etudiant"=>$etudiant,'ville'=>$ville]);
       
            //   return Redirect::route('confirmation',$req->apogee,["etudiant"=>$etudiant,'ville'=>$ville]);
                return view("confirmation/affiche",["etudiant"=>$etudiant,'ville'=>$ville,$id])->with(["etudiant"=>$etudiant,'ville'=>$ville,$id]);
            // return redirect()->view('confirmation',$id);
            // return URL::signedRoute('confirmation',[$id,"etudiant"=>$etudiant,'ville'=>$ville]);
             
        }
    }
    public function update( $id){
        $etudiant = Etudiant::findOrFail($id);
        $email = $etudiant->email;
        $name = $etudiant->Nom;
        $apogee = $etudiant->Apogee;
        DB::table('etudiants')
            ->where('Apogee',$apogee)
            ->update([
                "Etat"=>true,
                'confirmation_verified_at'=> now()
            ]);
            Mail::to($email)->send(new Confirmaion_mail($etudiant));
            // Mail::mailer('mailgun')->to($email)->send(new Confirmaion_mail);
            session()->flash('update',"$name, Vous avez confirmé votre présence au examen, un email de confirmation a été envoyer à votre adresse institutionnelle.");
            $info = DB::table('etudiants')
            ->join('filieres','filiere_id','=','filieres.id')
            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
            
            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
            ->where('Apogee',  $apogee)
            ->get();
         
         return view("confirmation.show",["etudiant"=>$info]);
    }
    public function examen($id){
        $etudiant = Etudiant::findOrfail($id);
        $villes = ExamenVille::all();
        $url = URL::signedRoute('centre.examen',[$id]);
         return view('confirmation.ville',[$url,'villes'=>$villes,'etudiant'=>$etudiant]);
        // return URL::signedRoute('centre.examen',[$id]);
       

    }

    public function confirmation( $id){
        $etudiant = Etudiant::findOrFail($id);
        $name = $etudiant->Nom;
        $prenom = $etudiant->Prenom;
        $apogee = $etudiant->Apogee;
        $info = DB::table('etudiants')
            ->join('filieres','filiere_id','=','filieres.id')
            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
            
            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
            ->where('Apogee',  $apogee)
            ->get();
        $pdf = PDF::loadView('export.confirmation',["etudiant"=>$info])->setPaper('a4', 'portrait');;
        return $pdf->download(''.$name.' '.$prenom.' confirmation.pdf');
    }
    
}
