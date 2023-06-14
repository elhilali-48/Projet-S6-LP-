<?php

namespace App\Http\Controllers;


use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Charts\Etat_date_confirmation;


class Droit_Controller extends Controller
{
    public function semestre2(Request $request,Etudiant $etudiant){
        $confirm = "1";
        $search = null;
        $confirm = DB::table('etudiants')
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","1")
                    ->where('semestre_id','=',"1")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->count();

        $total =  DB::table('etudiants')
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where('semestre_id','=',"1")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->count();
        
        $nconfirm = DB::table('etudiants')
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","0")
                    ->where('semestre_id','=',"1")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->count();

        $sectionA = DB::table('etudiants')
                     ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","1")
                    ->where('semestre_id','=',"1")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->where('Section','=','A')
                    ->count();
        
        if($request->has('search'))$search = $request->query('search');
        $etudiant_SA = DB::table('etudiants')
        ->where([['semestre_id','=',"1"],['Section','=','A']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["2","5","6"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where([['semestre_id','=',"1"],['Section','=','A']])
                   ->where('Apogee','like','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                  //   ->where('Section','=','A')
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where([['semestre_id','=',"1"],['Section','=','A']])
                
                   ->get();
        
        $sectionB = DB::table('etudiants')
                    ->join('filieres','filiere_id','=','filieres.id')
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where("Etat","=","1")
                   ->where('semestre_id','=',"1")
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where('Section','=','B')
                   ->count();

         $etudiant_SB = DB::table('etudiants')
                   ->where([['semestre_id','=',"1"],['Section','=','B']])
                               ->join('filieres','filiere_id','=','filieres.id')
                               ->whereIn('filiere_id',["2","5","6"])
                              ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                              ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                              ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                              ->where('Apogee','like','%'.$search.'%')
                              // ->orWhere('NOM','=','%'.$search.'%')
                               ->orWhere('CNE','like','%'.$search.'%')
                               ->where('Section','=','B')
                              ->whereIn('filiere_id',["2","5","6"])
                              ->where([['semestre_id','=',"1"],['Section','=','B']])
                           //    ->where('semestre_id','=',"1")
                           //    ->where('Section','=','A')
                              ->whereIn('filiere_id',["2","5","6"])
                           
                              ->get();
         $sectionC = DB::table('etudiants')
                   ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"1")
                  ->whereIn('filiere_id',["2","5","6"])
                  ->where('Section','=','C')
                  ->count();
        $etudiant_SC = DB::table('etudiants')
        ->where([['semestre_id','=',"1"],['Section','=','C']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["2","5","6"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where('Apogee','like','%'.$search.'%')
                   // ->orWhere('NOM','=','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                    ->where('Section','=','C')
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where([['semestre_id','=',"1"],['Section','=','C']])
                //    ->where('semestre_id','=',"1")
                //    ->where('Section','=','A')
                   ->whereIn('filiere_id',["2","5","6"])
                
                   ->get();
        $sectionD = DB::table('etudiants')
                             ->join('filieres','filiere_id','=','filieres.id')
                            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                            ->where("Etat","=","1")
                            ->where('semestre_id','=',"1")
                            ->whereIn('filiere_id',["2","5","6"])
                            ->where('Section','=','D')
                            ->count();

        $etudiant_SD = DB::table('etudiants')
        ->where([['semestre_id','=',"1"],['Section','=','D']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["2","5","6"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where([['semestre_id','=',"1"],['Section','=','D']])
                   ->where('Apogee','like','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                  //   ->where('Section','=','D')
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where([['semestre_id','=',"1"],['Section','=','D']])
                
                   ->get();

        $sectionE = DB::table('etudiants')
                            ->join('filieres','filiere_id','=','filieres.id')
                           ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                           ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                           ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                           ->where("Etat","=","1")
                           ->where('semestre_id','=',"1")
                           ->whereIn('filiere_id',["2","5","6"])
                           ->where('Section','=','E')
                           ->count();

       $etudiant_SE = DB::table('etudiants')
       ->where([['semestre_id','=',"1"],['Section','=','E']])
                   ->join('filieres','filiere_id','=','filieres.id')
                   ->whereIn('filiere_id',["2","5","6"])
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where([['semestre_id','=',"1"],['Section','=','E']])
                  ->where('Apogee','like','%'.$search.'%')
                   ->orWhere('CNE','like','%'.$search.'%')
                 //   ->where('Section','=','A')
                  ->whereIn('filiere_id',["2","5","6"])
                  ->where([['semestre_id','=',"1"],['Section','=','E']])
               
                  ->get();

     $sectionF =DB::table('etudiants')
        ->join('filieres','filiere_id','=','filieres.id')
        ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
        ->where("Etat","=","1")
        ->where('semestre_id','=',"1")
        ->whereIn('filiere_id',["2","5","6"])
        ->where('Section','=','F')
        ->count();

      $etudiant_SF = DB::table('etudiants')
      ->where([['semestre_id','=',"1"],['Section','=','F']])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->whereIn('filiere_id',["2","5","6"])
                 ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                 ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                 ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                 ->where('Apogee','like','%'.$search.'%')
                 // ->orWhere('NOM','=','%'.$search.'%')
                  ->orWhere('CNE','like','%'.$search.'%')
                  ->where('Section','=','F')
                 ->whereIn('filiere_id',["2","5","6"])
                 ->where([['semestre_id','=',"1"],['Section','=','F']])
              //    ->where('semestre_id','=',"1")
              //    ->where('Section','=','A')
                 ->whereIn('filiere_id',["2","5","6"])
              
                 ->get();
                                       
        $chart = new Etat_date_confirmation;
        $chart->title('Réparition des confirmations par Section', 19, "#F95909", true, 'Helvetica Neue');
        $chart->barwidth(0.8);
        $chart->displaylegend(false);
        $chart->labels(['Section-A', 'Section-B','Section-C','Section-D','Section-E','Section-F']);
        $chart->dataset('Nombre de confirmation', 'bar', [$sectionA, $sectionB,$sectionC,$sectionD,$sectionE,$sectionF])
               ->backgroundColor(['#F4D03F','#5D6D7E','#EC7063','#3498DB','#2ECC71','#C39BD3'])
               ;
         $chart->options([
            'hoverBackgroundColor'=>'red'
         ]);

        return view('droit.semestre2',compact('total','confirm','nconfirm','chart','etudiant_SA','etudiant_SB','etudiant_SC','etudiant_SE','etudiant_SD','etudiant_SF'));
    }



    public function semestre4(Request $request,Etudiant $etudiant){
        $confirm = "1";
        $search = null;
        $confirm = DB::table('etudiants')
                  ->whereIn('Section',["A",'B','C','D','E'])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","1")
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->count();

        $total =  DB::table('etudiants')
        ->whereIn('Section',["A",'B','C','D','E'])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->count();
        
        $nconfirm = DB::table('etudiants')
        ->whereIn('Section',["A",'B','C','D','E'])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","0")
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->count();

        $sectionA = DB::table('etudiants')
                     ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","1")
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["2","5","6"])
                    ->where('Section','=','A')
                    ->count();
        
        if($request->has('search'))$search = $request->query('search');
        $etudiant_SA = DB::table('etudiants')
        ->where([['semestre_id','=',"2"],['Section','=','A']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["2","5","6"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where([['semestre_id','=',"2"],['Section','=','A']])
                   ->where('Apogee','like','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                  //   ->where('Section','=','A')
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where([['semestre_id','=',"2"],['Section','=','A']])
                
                   ->get();
        
        $sectionB = DB::table('etudiants')
                    ->join('filieres','filiere_id','=','filieres.id')
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where("Etat","=","1")
                   ->where('semestre_id','=',"2")
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where('Section','=','B')
                   ->count();

         $etudiant_SB = DB::table('etudiants')
                   ->where([['semestre_id','=',"2"],['Section','=','B']])
                               ->join('filieres','filiere_id','=','filieres.id')
                               ->whereIn('filiere_id',["2","5","6"])
                              ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                              ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                              ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                              ->where('Apogee','like','%'.$search.'%')
                              // ->orWhere('NOM','=','%'.$search.'%')
                               ->orWhere('CNE','like','%'.$search.'%')
                               ->where('Section','=','B')
                              ->whereIn('filiere_id',["2","5","6"])
                              ->where([['semestre_id','=',"2"],['Section','=','B']])
                           //    ->where('semestre_id','=',"1")
                           //    ->where('Section','=','A')
                              ->whereIn('filiere_id',["2","5","6"])
                           
                              ->get();
         $sectionC = DB::table('etudiants')
                   ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"2")
                  ->whereIn('filiere_id',["2","5","6"])
                  ->where('Section','=','C')
                  ->count();
        $etudiant_SC = DB::table('etudiants')
        ->where([['semestre_id','=',"2"],['Section','=','C']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["2","5","6"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where('Apogee','like','%'.$search.'%')
                   // ->orWhere('NOM','=','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                    ->where('Section','=','C')
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where([['semestre_id','=',"2"],['Section','=','C']])
                //    ->where('semestre_id','=',"1")
                //    ->where('Section','=','A')
                   ->whereIn('filiere_id',["2","5","6"])
                
                   ->get();
        $sectionD = DB::table('etudiants')
                             ->join('filieres','filiere_id','=','filieres.id')
                            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                            ->where("Etat","=","1")
                            ->where('semestre_id','=',"2")
                            ->whereIn('filiere_id',["2","5","6"])
                            ->where('Section','=','D')
                            ->count();

        $etudiant_SD = DB::table('etudiants')
        ->where([['semestre_id','=',"2"],['Section','=','D']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["2","5","6"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where([['semestre_id','=',"2"],['Section','=','D']])
                   ->where('Apogee','like','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                  //   ->where('Section','=','D')
                   ->whereIn('filiere_id',["2","5","6"])
                   ->where([['semestre_id','=',"2"],['Section','=','D']])
                
                   ->get();

        $sectionE = DB::table('etudiants')
                            ->join('filieres','filiere_id','=','filieres.id')
                           ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                           ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                           ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                           ->where("Etat","=","1")
                           ->where('semestre_id','=',"2")
                           ->whereIn('filiere_id',["2","5","6"])
                           ->where('Section','=','E')
                           ->count();

       $etudiant_SE = DB::table('etudiants')
       ->where([['semestre_id','=',"2"],['Section','=','E']])
                   ->join('filieres','filiere_id','=','filieres.id')
                   ->whereIn('filiere_id',["2","5","6"])
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where([['semestre_id','=',"2"],['Section','=','E']])
                  ->where('Apogee','like','%'.$search.'%')
                   ->orWhere('CNE','like','%'.$search.'%')
                 //   ->where('Section','=','A')
                  ->whereIn('filiere_id',["2","5","6"])
                  ->where([['semestre_id','=',"2"],['Section','=','E']])
               
                  ->get();

     
                                       
        $chart = new Etat_date_confirmation;
        $chart->title('Réparition des confirmations par Section', 19, "#F95909", true, 'Helvetica Neue');
        $chart->barwidth(0.6);
        $chart->displaylegend(false);
        $chart->labels(['Section-A', 'Section-B','Section-C','Section-D','Section-E']);
        $chart->dataset('Nombre de confirmation', 'bar', [$sectionA, $sectionB,$sectionC,$sectionD,$sectionE])->backgroundColor(['#09F996','#97DEFF','#C135EE','#FFE22B','#D94A66']);

        return view('droit.semestre4',compact('total','confirm','nconfirm','chart','etudiant_SA','etudiant_SB','etudiant_SC','etudiant_SE','etudiant_SD'));
    }

    public function semestre6(Request $request,Etudiant $etudiant){
      $confirm = "1";
      $search = null;
      $confirm = DB::table('etudiants')
      ->whereIn('Section',["A",'B','C'])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["2","5","6"])
                  ->count();

      $total =  DB::table('etudiants')
       ->whereIn('Section',["A",'B','C'])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["2","5","6"])
                  ->count();
      
      $nconfirm = DB::table('etudiants')
      ->whereIn('Section',["A",'B','C'])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","0")
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["2","5","6"])
                  ->count();

      $Droit_Public = DB::table('etudiants')
      // ->whereIn('Section',["A",'B','C'])// il faut supprimer
                   ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',['5'])
                  ->count();
      
      if($request->has('search'))$search = $request->query('search');
      $etudiant_Droit_Public = DB::table('etudiants')
      ->where([['semestre_id','=',"3"],['filiere_id','=',"5"]])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->whereIn('filiere_id',["5"])
                 ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                 ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                 ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                 ->where('Apogee','like','%'.$search.'%')
                  ->orWhere('CNE','like','%'.$search.'%')
                 ->whereIn('filiere_id',["5"])
                 ->where([['semestre_id','=',"3"],['filiere_id','=',"5"]])
                 ->whereIn('filiere_id',["5"])
                 ->get();
         
      
      $Droit_Privee_SA = DB::table('etudiants')
                  ->join('filieres','filiere_id','=','filieres.id')
                 ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                 ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                 ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                 ->where("Etat","=","1")
                 ->where('semestre_id','=',"3")
                 ->whereIn('filiere_id',["6"])
                 ->where('Section','=','A')
                 ->count();

      $etudiant_Droit_Privee_SA = DB::table('etudiants')
      
                 ->where([['semestre_id','=',"3"],['Section','=','A'],['filiere_id','=',"6"]])
                             ->join('filieres','filiere_id','=','filieres.id')
                           //   ->whereIn('filiere_id',["6"])
                            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                            ->where('Apogee','like','%'.$search.'%')
                            // ->orWhere('NOM','=','%'.$search.'%')
                             ->orWhere('CNE','like','%'.$search.'%')
                           //   ->where('Section','=','A')
                           //  ->whereIn('filiere_id',["6"])
                            ->where([['semestre_id','=',"3"],['Section','=','A'],['filiere_id','=',"6"]])
                        
                           //  ->whereIn('filiere_id',["6"])
                            ->get();
      $Droit_Privee_SB = DB::table('etudiants')
                        ->where('Section','=','B')
                            ->join('filieres','filiere_id','=','filieres.id')
                           ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                           ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                           ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                           ->where("Etat","=","1")
                           ->where('semestre_id','=',"3")
                           ->whereIn('filiere_id',["6"])
                           ->where('Section','=','B')
                           ->count();
          
      $etudiant_Droit_Privee_SB = DB::table('etudiants')
                           ->where([['semestre_id','=',"3"],['Section','=','B'],['filiere_id','=',"6"]])
                                       ->join('filieres','filiere_id','=','filieres.id')
                                       ->whereIn('filiere_id',["6"])
                                      ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                                      ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                                      ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                                      ->where('Apogee','like','%'.$search.'%')
                                      // ->orWhere('NOM','=','%'.$search.'%')
                                       ->orWhere('CNE','like','%'.$search.'%')
                                       ->where('Section','=','B')
                                      ->whereIn('filiere_id',["6"])
                                      ->where([['semestre_id','=',"3"],['Section','=','B'],['filiere_id','=',"6"]])
                                   //    ->where('semestre_id','=',"1")
                                      ->where('Section','=','B')
                                      ->whereIn('filiere_id',["6"])
                                      ->get();
         $Droit_Privee_SC = DB::table('etudiants')
                                      ->join('filieres','filiere_id','=','filieres.id')
                                     ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                                     ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                                     ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                                     ->where("Etat","=","1")
                                     ->where('semestre_id','=',"3")
                                     ->whereIn('filiere_id',["6"])
                                     ->where('Section','=','C')
                                     ->count();
                    
         $etudiant_Droit_Privee_SC = DB::table('etudiants')
                                     ->where([['semestre_id','=',"3"],['Section','=','C'],['filiere_id','=',"6"]])
                                                 ->join('filieres','filiere_id','=','filieres.id')
                                                 ->whereIn('filiere_id',["6"])
                                                ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                                                ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                                                ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                                                ->where('Apogee','like','%'.$search.'%')
                                                // ->orWhere('NOM','=','%'.$search.'%')
                                                 ->orWhere('CNE','like','%'.$search.'%')
                                                 ->where('Section','=','C')
                                                ->whereIn('filiere_id',["6"])
                                                ->where([['semestre_id','=',"3"],['Section','=','C'],['filiere_id','=',"6"]])
                                             //    ->where('semestre_id','=',"1")
                                             //    ->where('Section','=','A')
                                                ->whereIn('filiere_id',["6"])
                                                ->get();
      $chart = new Etat_date_confirmation;
      $chart->title('Réparition des confirmations par Section', 19, "#F95909", true, 'Helvetica Neue');
      $chart->barwidth(0.6);
      $chart->displaylegend(false);
      $chart->labels(['Droit Public', 'Droit_Privee_SA','Droit_Privee_SB','Droit_Privee_SC']);
      $chart->dataset('Nombre de confirmation', 'bar', [$Droit_Public, $Droit_Privee_SA,$Droit_Privee_SB,$Droit_Privee_SC])->backgroundColor(['blue',"#FFB533","#33FFE9",'#E933FF']);

      return view('droit.semestre6',compact('total','confirm','nconfirm','chart','etudiant_Droit_Public','etudiant_Droit_Privee_SA','etudiant_Droit_Privee_SB','etudiant_Droit_Privee_SC'));
}}
