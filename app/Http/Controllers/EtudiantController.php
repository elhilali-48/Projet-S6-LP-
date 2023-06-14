<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Semestre_Etudiant;
use App\Filiere;
use App\Http\Requests\Etudiant_Request;
use App\Semestre;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $filiere = Filiere::all();
        $semestre = Semestre::all();
        
        return view("etudiants.create",['filiere'=>$filiere],['semestre'=>$semestre]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Etudiant_Request $request)
    {
       
        $etudiant = Etudiant::create([
            'Nom'=>$request->nom,
            'Prenom'=>$request->prenom,
            'Apogee'=>$request->Apogee,
            'CNE'=>$request->CNE,
            'CIN'=>$request->CIN,
            'date_naissance'=>$request->date,
            'email'=>$request->email,
            'Section'=>$request->section,
            'filiere_id'=>$request->filiere,
        ]);
        if($request->semestre){
            $etudiant->semestres()->attach($request->semestre);
        }
       
        session()->flash('success',"$request->nom est bien ajouté");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $filiere = Filiere::all();
        $semestre = Semestre::all();
        
        return view("etudiants.edit",["etudiant"=>$etudiant,'filiere'=>$filiere,'semestre'=>$semestre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Etudiant_Request $request, $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->Nom = $request->nom;
        $etudiant->Prenom = $request->prenom;
        $etudiant->Apogee = $request->Apogee;
        $etudiant->CNE = $request->CNE;
        $etudiant->CIN = $request->CIN;
        $etudiant->date_naissance = $request->date;
        $etudiant->email = $request->email;
        $etudiant->Section = $request->section;
        $etudiant->filiere_id = $request->filiere;
        if($request->semestre){
            $etudiant->semestres()->sync($request->semestre);

        }
        $etudiant->save();
        // $data= $request->only([
        //     "nom",
        //     "prenom",
        //     "Apogee",
        //     "CNE",
        //     "CIN",
        //     "date",
        //     "email",
        //     "section",
        //     "filiere",
        // ]);
        
      
        // $etudiant->update($data);

        $request->session()->flash('success',"Les informations de l'étudiant : $etudiant->Nom est bien modifié");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etudiant = Etudiant::withTrashed()->where('id',$id)->first();
        if($etudiant->trashed()){
            
            $etudiant->forceDelete();
            session()->flash('delete',"$etudiant->Nom est supprimé de la liste des étudiants");
            return redirect()->back();
        }else{
         $etudiant->delete();
         session()->flash('warning',"$etudiant->Nom est supprimé partiellement");
         return redirect()->back();
        } 
    }
    public function trashed() {
        $trashed = Etudiant::onlyTrashed()->get();
        return view('etudiants.trashed',compact('trashed'));
    }
    public function restore($id){
        $etudiant = Etudiant::withTrashed()->where('id',$id)->first();
        $id = Etudiant::withTrashed()->where('id',$id)->restore();
        session()->flash('success',"L'étudiant $etudiant->Nom est bien restauré");
        return redirect()->back();
    }
    public function restoreall(){
        $etudiant = Etudiant::withTrashed()->restore();
        session()->flash('success',"Tous les étudiants sont réstaurés");
        return redirect()->back();
    }
}
