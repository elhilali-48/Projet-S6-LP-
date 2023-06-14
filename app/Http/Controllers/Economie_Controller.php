<?php



namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;

use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Charts\Etat_date_confirmation;



class Economie_Controller extends Controller
{
    public function semestre2(Request $request,Etudiant $etudiant){
      $confirm = "1";
      $search = null;
      $confirm = DB::table('etudiants')
            ->whereIn('Section',["A",'B','C'])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->whereIn('filiere_id',["1","3","4"])
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"1")
                  ->whereIn('filiere_id',["1","3","4"])
                  ->count();

       $total =  DB::table('etudiants')
       ->whereIn('Section',["A",'B','C'])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where('semestre_id','=',"1")
                  ->whereIn('filiere_id',["1","3","4"])
                  ->count();
      
      $nconfirm = DB::table('etudiants')
      ->whereIn('Section',["A",'B','C'])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","0")
                  ->where('semestre_id','=',"1")
                  ->whereIn('filiere_id',["1","3","4"])
                  ->count();

        $sectionA = DB::table('etudiants')
                     ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","1")
                    ->where('semestre_id','=',"1")
                    ->whereIn('filiere_id',["1","3","4"])
                    ->where('Section','=','A')
                    ->count();
        
        if($request->has('search'))$search = $request->query('search');
        $etudiant_SA = DB::table('etudiants')
        ->where([['semestre_id','=',"1"],['Section','=','A']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["1","3","4"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where([['semestre_id','=',"1"],['Section','=','A']])
                   ->where('Apogee','like','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                  //   ->where('Section','=','A')
                   ->whereIn('filiere_id',["1","3","4"])
                   ->where([['semestre_id','=',"1"],['Section','=','A']])
                
                   ->get();
        
        $sectionB = DB::table('etudiants')
                    ->join('filieres','filiere_id','=','filieres.id')
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where("Etat","=","1")
                   ->where('semestre_id','=',"1")
                   ->whereIn('filiere_id',["1","3","4"])
                   ->where('Section','=','B')
                   ->count();

         $etudiant_SB = DB::table('etudiants')
                   ->where([['semestre_id','=',"1"],['Section','=','B']])
                               ->join('filieres','filiere_id','=','filieres.id')
                               ->whereIn('filiere_id',["1","3","4"])
                              ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                              ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                              ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                              ->where('Apogee','like','%'.$search.'%')
                              // ->orWhere('NOM','=','%'.$search.'%')
                               ->orWhere('CNE','like','%'.$search.'%')
                               ->where('Section','=','B')
                              ->whereIn('filiere_id',["1","3","4"])
                              ->where([['semestre_id','=',"1"],['Section','=','B']])
                           //    ->where('semestre_id','=',"1")
                           //    ->where('Section','=','A')
                              ->whereIn('filiere_id',["1","3","4"])
                           
                              ->get();
         $sectionC = DB::table('etudiants')
         ->join('filieres','filiere_id','=','filieres.id')
        ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
        ->where("Etat","=","1")
        ->where('semestre_id','=',"1")
        ->whereIn('filiere_id',["1","3","4"])
        ->where('Section','=','C')
        ->count();
        $etudiant_SC = DB::table('etudiants')
        ->where([['semestre_id','=',"1"],['Section','=','C']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["1","3","4"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where('Apogee','like','%'.$search.'%')
                   // ->orWhere('NOM','=','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                    ->where('Section','=','C')
                   ->whereIn('filiere_id',["1","3","4"])
                   ->where([['semestre_id','=',"1"],['Section','=','B']])
                //    ->where('semestre_id','=',"1")
                //    ->where('Section','=','A')
                   ->whereIn('filiere_id',["1","3","4"])
                
                   ->get();
        $chart = new Etat_date_confirmation;
        $chart->title('Réparition des confirmations par Section', 19, "#F95909", true, 'Helvetica Neue');
        $chart->barwidth(0.6);
        $chart->displaylegend(false);
        $chart->labels(['Section-A', 'Section-B','Section-C']);
        $chart->dataset('Nombre de confirmation', 'bar', [$sectionA, $sectionB,$sectionC])->backgroundColor(['#377BC7',"#896215",'#EC0F0F']);

        return view('economie.semestre2',compact('total','confirm','nconfirm','chart','etudiant_SA','etudiant_SB','etudiant_SC'));
    }
   

    public function semestre4(Request $request,Etudiant $etudiant){
        $confirm = "1";
        $search = null;
        $confirm = DB::table('etudiants')
        ->whereIn('Section',["A",'B'])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","1")
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["1","3","4"])
                    ->count();

        $total =  DB::table('etudiants')
                    ->whereIn('Section',['A','B'])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["1","3","4"])
                    ->count();
        
        $nconfirm = DB::table('etudiants')
                     ->whereIn('Section',['A','B'])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","0")
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["1","3","4"])
                    ->count();

        $sectionA = DB::table('etudiants')
                     ->join('filieres','filiere_id','=','filieres.id')
                    ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                    ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                    ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                    ->where("Etat","=","1")
                    ->where('semestre_id','=',"2")
                    ->whereIn('filiere_id',["1","3","4"])
                    ->where('Section','=','A')
                    ->count();
        
        if($request->has('search'))$search = $request->query('search');
       
        $etudiant_SA = DB::table('etudiants')
        ->where([['semestre_id','=',"2"],['Section','=','A']])
                    ->join('filieres','filiere_id','=','filieres.id')
                    ->whereIn('filiere_id',["1","3","4"])
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where('Apogee','like','%'.$search.'%')
                   // ->orWhere('NOM','=','%'.$search.'%')
                    ->orWhere('CNE','like','%'.$search.'%')
                    ->where('Section','=','A')
                   ->whereIn('filiere_id',["1","3","4"])
                   ->where([['semestre_id','=',"2"],['Section','=','A']])
                //    ->where('semestre_id','=',"1")
                //    ->where('Section','=','A')
                   ->whereIn('filiere_id',["1","3","4"])
                
                   ->get();
        
        $sectionB = DB::table('etudiants')
                    ->join('filieres','filiere_id','=','filieres.id')
                   ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                   ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                   ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                   ->where("Etat","=","1")
                   ->where('semestre_id','=',"2")
                   ->whereIn('filiere_id',["1","3","4"])
                   ->where('Section','=','B')
                   ->count();

         $etudiant_SB = DB::table('etudiants')
                   ->where([['semestre_id','=',"2"],['Section','=','B']])
                               ->join('filieres','filiere_id','=','filieres.id')
                               ->whereIn('filiere_id',["1","3","4"])
                              ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                              ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                              ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                              ->where('Apogee','like','%'.$search.'%')
                              // ->orWhere('NOM','=','%'.$search.'%')
                               ->orWhere('CNE','like','%'.$search.'%')
                               ->where('Section','=','B')
                              ->whereIn('filiere_id',["1","3","4"])
                              ->where([['semestre_id','=',"2"],['Section','=','B']])
                           //    ->where('semestre_id','=',"1")
                           //    ->where('Section','=','A')
                              ->whereIn('filiere_id',["1","3","4"])
                           
                              ->get();
        
        $chart = new Etat_date_confirmation;
        $chart->title('Réparition des confirmations par Section', 19, "#F95909", true, 'Helvetica Neue');
        $chart->barwidth(0.6);
        $chart->displaylegend(false);
        $chart->labels(['Section-A', 'Section-B']);
        $chart->dataset('Nombre de confirmation', 'bar', [$sectionA, $sectionB])->backgroundColor(['#68FFFA',"#B7F67E"]);

        return view('economie.semestre4',compact('total','confirm','nconfirm','chart','etudiant_SA','etudiant_SB'));
    }

    public function semestre6(Request $request,Etudiant $etudiant){
      $confirm = "1";
      $search = null;
      $confirm = DB::table('etudiants')
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["3","4"])
                  ->count();

      $total =  DB::table('etudiants')
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["3","4"])
                  ->count();
      
      $nconfirm = DB::table('etudiants')
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","0")
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["3","4"])
                  ->count();

      $ECO_GES = DB::table('etudiants')
                   ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["4"])
                  ->count();
      
      if($request->has('search'))$search = $request->query('search');
     
      $etudiant_ECO_GES = DB::table('etudiants')
      ->where([['semestre_id','=',"3"],['filiere_id','=',"4"]])
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->whereIn('filiere_id',["4"])
                 ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                 ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                 ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                 ->where('Apogee','like','%'.$search.'%')
                  ->orWhere('CNE','like','%'.$search.'%')
                 ->whereIn('filiere_id',["4"])
                 ->where([['semestre_id','=',"3"],['filiere_id','=',"4"]])
                 ->whereIn('filiere_id',["4"])
                 ->get();
      
      $GES =  DB::table('etudiants')
                  ->join('filieres','filiere_id','=','filieres.id')
                  ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                  ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                  ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                  ->where("Etat","=","1")
                  ->where('semestre_id','=',"3")
                  ->whereIn('filiere_id',["3"])
                  ->count();

       $etudiant_GES = DB::table('etudiants')
                 ->where([['semestre_id','=',"3"],['filiere_id','=','3']])
                             ->join('filieres','filiere_id','=','filieres.id')
                             ->whereIn('filiere_id',["3"])
                            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                            ->where('Apogee','like','%'.$search.'%')
                             ->orWhere('CNE','like','%'.$search.'%')
                             
                            ->whereIn('filiere_id',["3"])
                            ->where([['semestre_id','=',"3"],['filiere_id','=','3']])
                            ->whereIn('filiere_id',["3"])
                         
                            ->get();
      
      $chart = new Etat_date_confirmation;
      $chart->title('Réparition des confirmations par Section', 19, "#F95909", true, 'Helvetica Neue');
      $chart->barwidth(0.6);
      $chart->displaylegend(false);
      $chart->labels(['ECO & GESTION', 'GESTION']);
      $chart->dataset(("Nombre de confirmation"), 'bar', [$ECO_GES, $GES])
            ->backgroundColor(['yellow',"green"])
            ->options([
               'fill' => 'true',
               'borderColor' => '#FFF',
               'barPercentage' => "1",
               'fontColor'=> 'black',
               'backgroundColor'=> ['red','blue'],
               'responsive'=> true
             
           ])
            
            ;
      
      
   
      return view('economie.semestre6',compact('total','confirm','nconfirm','chart','etudiant_ECO_GES','etudiant_GES'));
  }
   

  public function confirm($id){
     $etudiant = Etudiant::findOrfail($id);
     if($etudiant){
        $etudiant->Etat = true;
        $etudiant->confirmation_verified_at = now();
        $etudiant->save();
        return redirect()->back();
     }
  }


  public function eco_pdf(Request $request ){
   if($request->has('confirm')){
      $confirm = $request->confirm;
      $etudiant= DB::table('etudiants')
      ->join('filieres','filiere_id','=','filieres.id')
      ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
      ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
      ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
      ->whereIn('filiere_id',["1","3",'4'])
      ->where('Etat',$confirm)
      ->get();
      $count= DB::table('etudiants')
      ->join('filieres','filiere_id','=','filieres.id')
      ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
      ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
      ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
      ->whereIn('filiere_id',["1","3",'4'])
      ->where('Etat',$confirm)
      ->count();
      $pdf = PDF::loadView('export.eco',["economie"=>$etudiant,'count'=>$count])->setPaper('a4', 'portrait');;
      return $pdf->download('Eco.pdf');
  }
  else{
     return redirect()->back();
  }
   //    $confirm = $request->confirm;
   // $etudiant = DB::table('etudiants')
   // ->where('Etat',$confirm)
   // ->join('filieres','filiere_id','=','filieres.id')
   // ->whereIn('filiere_id',["1","3","4"])
   // ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
   // ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
   // ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
   // ->whereIn('filiere_id',["1","3","4"])
   // ->get();
   // $count = DB::table('etudiants')
   // ->where('Etat',$confirm)
   // ->join('filieres','filiere_id','=','filieres.id')
   // ->whereIn('filiere_id',["1","3","4"])
   // ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
   // ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
   // ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
   // ->whereIn('filiere_id',["1","3","4"])
   // ->count();
  
   }
  
}
