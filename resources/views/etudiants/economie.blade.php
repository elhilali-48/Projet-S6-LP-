@extends('layouts.appj2')
@section('stylesheets')
  <style>
    button ,a  {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
</style>

@endsection
@section('content')
<div class="container">
    <div class="row-justify-content-center">
        <div class="col-md-12">
          @if (session()->has('warning'))
          <div style="border-radius: 7px" class="alert alert-warning alert-dismissible fade show " role='alert' >
            <h5 class="text-center">{{session()->get('warning')}}</h5>
            <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&timesbar;</span>
            </button>
          </div>
          @endif
        <div class="row text-center">
          <div class="col-md-4 ">
            <div class="card bg-success   mt-3 " style="border-radius: 7px ">
                <div class="card-header">
                    
                    <h5 class="font-weight-bold">Total de confirmation</h5>
                   
                </div>
                <div class="card-body ">
                   <b style="font-size: 25px" >{{$total}}</b>
                </div>
              </div>
            </div>
            <div class="col-md-4 ">
            <div class="card bg-info text-black mt-3 " style="border-radius: 7px">
                <div class="card-header">
                    
                    <h5 class="font-weight-bold">Total des étudiants</h5>
                </div>
                <div class="card-body">
                   <b style="font-size: 25px"> {{$etudiant_eco}}</b>
                </div>
            </div>
         </div>
         <div class="col-md-4  ">
            <div class="card bg-warning text-white mt-3" style="border-radius: 7px">
                <div class="card-header">
                    <h5 class="font-weight-bold text-white">Les étudiants non confirmés</h5>
                </div>
                <div class="card-body text-white">
                   
                    <b style="font-size: 25px">  {{$nconfirm}}</b>
                  
                </div>
            </div>
        </div>
      </div>
            <div class="col-md-12 mt-4 ">
                <div class="card bg-light  text-black" style="border-radius: 7px">
                    <div class="card-header text-enter ">
                        <h5 class="font-weight-bold font-italic">Etudiant : Economie
                          <div class="form-inline ml-3  float-right">
                           
                            <form method="GET" action="{{route('economie.filter')}}" class="form-inline ml-3 float-right">
                             
                              <select name="confirm" class="form-control form-control-sm" value="{{ $confirm }} ">
                               @foreach (['1','0'] as $con)
                               <option @if($con == $confirm) selected @endif value="{{ $con }}">{{ boolval($con) ? 'Confirmé': 'Non confirmé' }}</option>
                               @endforeach
                              </select>
                              <div class="input-group-append">
                                  <button class="btn btn-navbar" name="filter" type="submit">
                                    <i class="fas fa-search"></i>
                                  </button>
                                  <button name="export" class="btn btn-success  mr-5 float-right">
                                    <i class="fa fa-download" aria-hidden="true"></i> Export PDF
                                  </button>
                                  {{-- <a  class="btn btn-success  mr-5 float-right" href="{{action('Economie_Controller@eco_pdf')}}"> </a> --}}

                              </div>
                            </form>
                          {{-- <a class="btn btn-info " href="{{route('rappel.all')}}">Rappel All</a> --}}
                         
                          </div>
                            <form method="GET" action="{{route('etudiants.economie')}}" class="form-inline ml-3 float-right">
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Apogee,CNE" aria-label="Search">
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                                </button>
                            </div>
                            
                            </form><br><br>
                           
                   
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-striped table-hover " >
                                <thead style="width: 100%">
                                    <tr class="text-center">
                                      <th>Apogee</th>
                                      <th>Nom</th>
                                      <th>Prénom</th>
                                      <th>CNE/MASSAR</th>
                                      <th style="width: 12%"> Date de naissance</th>
                                      <th>Semestre</th>
                                      <th>Section</th>
                                      <th>Status</th>
                                      <th style="width: 15%" >Outils</th>
                                    </tr>
                                  </thead>
                                  <tbody>
        
                                    @forelse ($economie as $etudiant)
                                    @if (!$etudiant->deleted_at)
                                    <tr class="table-info text-center">
                                      <th scope="row">{{$etudiant->Apogee}}</th>
                                          <td>{{$etudiant->Nom}}</td>
                                          <td>{{$etudiant->Prenom}}</td>
                                          <td>{{$etudiant->CNE}}</td>
                                          <td>{{$etudiant->date_naissance}}</td>
                                          <td>{{$etudiant->semestre}}</td>
                                          <td>{{$etudiant->Section}}</td>
                                          <td>
                                           @if ($etudiant->Etat)
                                              <span class="badge badge-success">Confirmé</span>
                                          @else
                                          <span class="badge badge-warning badge-small ">Non Confirmé</span>
                                          @endif
                                          </td>
                                          <td >
                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                             <button class=" float-right" title="Trashed" ><i class="fa fa-trash  " style="color: red"></i></button>
                                             </form>
                                             @if (Auth::user()->isAdmin())
                                             <span class="float-right ml-1" ><a href="{{route('etudiantt.edit',$etudiant->id)}}" title="Editer"><i class="fas fa-edit" style="color:rgb(238, 241, 6)"></i></a></span>
                                             @endif
                                            
                                            <span class="float-right" ><a href="{{route('etudiant.affiche',$etudiant->id)}}" title="Afficher les informations"><i class="fas fa-eye  " style="color: blue"></i></a></span>
                                            @if ($etudiant->Etat == false)
                                            @if (Auth::user()->isAdmin())
                                            <span class="float-right" >
                                             
                                              <form action="{{ route('etudiant.confirmation', $etudiant->id)}}" method="POST">
                                                @method('PUT')
                                                @csrf
                                               <button type="submit" title="Confirmer"><a href=""><i class="fa fa-check  " style="color : green"></i></a></button>
                                              </form>  
                                            </span>
                                            @endif
                                           
                                            @endif
                                        </td>
                                      </tr>
                                    @endif
                                   
                                    @empty
                                      <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe </td>
                                    @endforelse

                                    
                                  </tbody>
                            </table>
                        </div>
                    </div>
                   <div class="d-flex justify-content-center">
                    {{$economie->links()}}
                   </div> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection