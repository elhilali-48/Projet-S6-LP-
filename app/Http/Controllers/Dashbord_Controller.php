<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use App\Etudiant;
use App\Charts\Statistic_eco_droit;
use App\Charts\Etat_date_confirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ConfirmationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Rappel_Confirmation;


class Dashbord_Controller extends Controller
{
    public function index(){
        $total = DB::table('etudiants')->where('Etat','=',1)->count();
        $nconfirm = DB::table('etudiants')->where('Etat','=',0)->count();
        $etudiant = Etudiant::all()->count();

        $eco = DB::table('etudiants')->whereIn('filiere_id',["1","3",'4'])
                                    ->where('Etat','1')
                                    ->count();
        $droit = DB::table('etudiants')->whereIn('filiere_id',["2","5",'6'])
                                    ->where('Etat','1')
                                     ->count();

        
        //  $et = Etudiant::pluck('filiere_id','confirmation_verified_at');
        
         $nbr_confirmation = DB::table('etudiants')
         ->select(DB::raw('count(*),DATE_FORMAT(confirmation_verified_at, "%d-%b-%Y") as formatted_dob '))
         ->where('Etat','=','1')
         ->groupBy('formatted_dob')
         ->pluck('count(*)','formatted_dob');

        $last_confirmation = DB::table('etudiants')
        ->join('filieres','filiere_id','=','filieres.id')
        ->select('etudiants.*','filieres.filiere')
         ->where('Etat','=','1')
        ->orderBy('confirmation_verified_at','desc')
        ->limit(10)
        ->get();
        
       
        $chart2 = new Etat_date_confirmation;
        $chart2->title('Répartition des étudiants', 19, "rgb(58, 218, 254)", true, 'Helvetica Neue');
        $chart2->labels(['Eco', 'Droit']);
        $chart2->dataset('rate', 'doughnut', [$eco, $droit])->Color(['red',"blue"])->backgroundColor(['red',"blue"]);
        $chart2->options([
            'Color'=>'red'
        ]);
        
        
        $chart = new Etat_date_confirmation;
        $chart->title('Evolution des confirmations', 19, "#11F849", true, 'Helvetica Neue');
        $chart->barwidth(0.8);
        $chart->displaylegend(false);
        $chart->labels($nbr_confirmation->keys());
        $chart->dataset('Nombre de confirmation', 'line', $nbr_confirmation->values())->backgroundColor('#C9F9A1')->dashed([5])->linetension(0.5);
        


        return view('home',compact('total','etudiant','nconfirm','chart2','chart','nbr_confirmation','last_confirmation'));
    }

    public function economie(Request $request, Etudiant $etudiant){
        $confirm = "1";
        $search = null;
        $total = DB::table('etudiants')->whereIn('filiere_id',["1","3","4"])->where('Etat','=',1)->count();
        $nconfirm = DB::table('etudiants')->whereIn('filiere_id',["1","3","4"])->where('Etat','=',0)->count();
        $etudiant_eco = Etudiant::all()->whereIn('filiere_id',["1","3","4"])->count();
        if($request->has('search'))$search = $request->query('search');

        $etudiant = DB::table('etudiants')
        ->join('filieres','filiere_id','=','filieres.id')
        ->whereIn('filiere_id',["1","3","4"])
        ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
        ->where('Apogee','like','%'.$search.'%')
        // ->orWhere('NOM','=','%'.$search.'%')
        ->orWhere('CNE','like','%'.$search.'%')
        ->whereIn('filiere_id',["1","3","4"])
        ->paginate(20);
        return view('etudiants/economie', ["economie"=>$etudiant , "total"=>$total, "etudiant_eco"=>$etudiant_eco, "nconfirm"=>$nconfirm],["confirm"=>$confirm]);
    }

    public function search_eco(Request $request){
        //     $confirm= "";
        //     $search = $request->get('search');
        //     if(!$search){
        //         return redirect(route('etudiants.economie'));
        //     }
        //     $etudiant = DB::table('etudiants')
        //     ->join('filieres','filiere_id','=','filieres.id')
        //     ->whereIn('filiere_id',["1","3","4"])
        //     ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        //     ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        //     ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
        //     ->where('Apogee','like','%'.$search.'%')
        //     // ->orWhere('NOM','=','%'.$search.'%')
        //     ->orWhere('CNE','like','%'.$search.'%')
        //     ->whereIn('filiere_id',["1","3","4"])
        //     ->get();
        //     return view('etudiants/economie', ["economie"=>$etudiant] ,['confirm'=>$confirm]);
    }
    public function search_droit(Request $request){

        // $search = $request->get('search');
        // if(!$search){
        //     return redirect(route('etudiants.droit'));
        // }
        // $etudiant = DB::table('etudiants')
        // ->join('filieres','filiere_id','=','filieres.id')
        // ->whereIn('filiere_id',["2","5","6"])
        // ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        // ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        // ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
        // ->where('Apogee','like','%'.$search.'%')
        // // ->orWhere('NOM','LIKE','%'.$search.'%')
        // ->orWhere('CNE','like','%'.$search.'%')
        // ->whereIn('filiere_id',["2","5","6"])
        // ->get();
        // return view('etudiants/droit', ["droit"=>$etudiant]);
    }

    public function droit(Request $request, Etudiant $etudiant){
        $confirm = "1";
        $search = null;
        $total = DB::table('etudiants')->whereIn('filiere_id',["2","5",'6'])->where('Etat','=',1)->count();
        $nconfirm = DB::table('etudiants')->whereIn('filiere_id',["2","5",'6'])->where('Etat','=',0)->count();
        $etudiant_droit = Etudiant::all()->whereIn('filiere_id',["2","5",'6'])->count();
        if($request->has('search'))$search = $request->query('search');
        $etudiant= DB::table('etudiants')
        ->join('filieres','filiere_id','=','filieres.id')
        ->whereIn('filiere_id',["2","5",'6'])
        ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
        ->where('Apogee','like','%'.$search.'%')
        // ->orWhere('NOM','LIKE','%'.$search.'%')
        ->orWhere('CNE','like','%'.$search.'%')
        ->whereIn('filiere_id',["2","5",'6'])
        ->paginate(20);
        return view('etudiants/droit',["droit"=>$etudiant, "total"=>$total, "etudiant_droit"=>$etudiant_droit, "nconfirm"=>$nconfirm],["confirm"=>$confirm]);
    }

    public function filter(Request $request){
        $confirm = $request->confirm;
        if($request->has('filter')){
            if($request->has('confirm')){
                $total = DB::table('etudiants')->whereIn('filiere_id',["1","3","4"])->where('Etat','=',1)->count();
                $nconfirm = DB::table('etudiants')->whereIn('filiere_id',["1","3","4"])->where('Etat','=',0)->count();
                $etudiant_eco = Etudiant::all()->whereIn('filiere_id',["1","3","4"])->count();
                $etudiant= DB::table('etudiants')
                ->join('filieres','filiere_id','=','filieres.id')
                ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                ->whereIn('filiere_id',["1","3",'4'])
                ->where('Etat',$confirm)
                ->paginate(50);
                return view('etudiants/economie',["economie"=>$etudiant, "total"=>$total, "etudiant_eco"=>$etudiant_eco, "nconfirm"=>$nconfirm],['confirm'=>$confirm]);
            }
        }
        elseif($request->has('export')){
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
            $etat = boolval($etudiant->first()->Etat)? 'confirmé':'Non confirmé';
            $pdf = PDF::loadView('export.eco',["economie"=>$etudiant,'count'=>$count])->setPaper('a4', 'portrait');
            return $pdf->download('Eco - '.$etat.'.pdf');
        }
       
    }
    public function filter_droit(Request $request){
        $confirm = $request->confirm;
        if($request->has('filter')){
            if($request->has('confirm')){
                $total = DB::table('etudiants')->whereIn('filiere_id',["2","5",'6'])->where('Etat','=',1)->count();
                $nconfirm = DB::table('etudiants')->whereIn('filiere_id',["2","5",'6'])->where('Etat','=',0)->count();
                $etudiant_droit = Etudiant::all()->whereIn('filiere_id',["2","5",'6'])->count();
                $confirm = $request->confirm;
                $etudiant= DB::table('etudiants')
                ->join('filieres','filiere_id','=','filieres.id')
                ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
                ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
                ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
                ->whereIn('filiere_id',["2","5","6"])
                ->where('Etat',$confirm)
                ->paginate(50);
                return view('etudiants/droit',["droit"=>$etudiant , "total"=>$total, "etudiant_droit"=>$etudiant_droit, "nconfirm"=>$nconfirm],['confirm'=>$confirm]);
            }
        }
        elseif($request->has('export')){
            $etudiant= DB::table('etudiants')
            ->join('filieres','filiere_id','=','filieres.id')
            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
            ->whereIn('filiere_id',["2","5","6"])
            ->where('Etat',$confirm)
            ->get();
            $count= DB::table('etudiants')
            ->join('filieres','filiere_id','=','filieres.id')
            ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
            ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
            ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
            ->whereIn('filiere_id',["2","5","6"])
            ->where('Etat',$confirm)
            ->count();
            $etat = boolval($etudiant->first()->Etat)? 'confirmé':'Non confirmé';
            $pdf = PDF::loadView('export.eco',["economie"=>$etudiant,'count'=>$count])->setPaper('a4', 'portrait');;
            return $pdf->download('Droit- '.$etat.'.pdf');
        }

    }

    public function affiche($id){
        $etudiant = Etudiant::find($id);
        $etudiant = DB::table('etudiants')
        
        ->join('filieres','filiere_id','=','filieres.id')
        ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        
        ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
         ->where('Apogee', '=', $etudiant->Apogee)
        ->get();
     return view("etudiants.affiche",["etudiant"=>$etudiant]);
    }
    public function rappel($id){
        $etudiant = Etudiant::findOrfail($id);
        
        
        $etudiant2 = DB::table('etudiants')
        
        ->join('filieres','filiere_id','=','filieres.id')
        ->join('semestre__etudiants','etudiants.id','=','semestre__etudiants.etudiant_id')
        ->join('semestres','semestre__etudiants.semestre_id','=','semestres.id')
        
        ->select('etudiants.*','filieres.filiere','semestre__etudiants.semestre_id','semestres.semestre')
         ->where('Apogee', '=', $etudiant->Apogee)
        ->get();
        Mail::to($etudiant->email)->send(new Rappel_Confirmation($etudiant));
        session()->flash('email',"Email de rappel a été envoyé avec succès
        ");
     return redirect()->back();
     
    }
    public function rappelall(){
        $etudiants = Etudiant::where('Etat','0')->get();
        foreach($etudiants as $etudiant){
            Mail::to($etudiant->email)->send(new Rappel_Confirmation($etudiant));
        }
        return redirect()->back();

    }
}
