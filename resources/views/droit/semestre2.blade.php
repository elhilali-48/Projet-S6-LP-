@extends('layouts.appj2')
@section('stylesheets')
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <style>
    button {
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
    @if (session()->has('warning'))
    <div style="border-radius: 7px" class="alert alert-warning alert-dismissible fade show " role='alert' >
      <h5 class="text-center">{{session()->get('warning')}}</h5>
      <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&timesbar;</span>
      </button>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <script>
                $(document).ready(function(){
                    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                        localStorage.setItem('activeTab', $(e.target).attr('href'));
                    });
                    var activeTab = localStorage.getItem('activeTab');
                    if(activeTab){
                        $('#myTab a[href="' + activeTab + '"]').tab('show');
                    }
                });
                </script>
                <nav class="nav nav-tabs" id="myTab">
                    <a class="nav-item nav-link" href="#p1" data-toggle="tab">Semestre 2</a>
                    <a class="nav-item nav-link" href="#p2" data-toggle="tab">Section A</a>
                    <a class="nav-item nav-link" href="#p3" data-toggle="tab">Section B</a>
                    <a class="nav-item nav-link" href="#p4" data-toggle="tab">Section C</a>
                    <a class="nav-item nav-link" href="#p5" data-toggle="tab">Section D</a>
                    <a class="nav-item nav-link" href="#p6" data-toggle="tab">Section E</a>
                    <a class="nav-item nav-link" href="#p7" data-toggle="tab">Section F</a>
                </nav>

                <div class="tab-content text-center">
                    <div class="tab-pane active" id="p1"> 
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="card bg-success   mt-3 " style="border-radius: 7px ">
                                    <div class="card-header">
                                        
                                        <h5 class="font-weight-bold">Total de confirmation</h5>
                                       
                                    </div>
                                    <div class="card-body ">
                                       <b style="font-size: 25px" > {{$confirm}}</b>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="card bg-info text-black mt-3 " style="border-radius: 7px">
                                    <div class="card-header">
                                        
                                        <h5 class="font-weight-bold">Total des étudiants</h5>
                                    </div>
                                    <div class="card-body">
                                       <b style="font-size: 25px"> {{$total}}</b>
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
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    {!! $chart->container() !!}
                                </div>
                            </div>
                            
                        
                           
                        </div>      
                        {!! $chart->script() !!}
                    </div>
                    <div class="tab-pane" id="p2">
                        <div class="row">
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    <div class="card-header">
                                        <h5 class=" font-weight-bold font-italic float-left">
                                            Droit - S2 - Section A -
                                        </h5>
                                    <form method="GET" action="" class="form-inline ml-3 float-right">
                                            <div class="input-group input-group-sm">
                                              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Apogee,CNE,Nom" aria-label="Search">
                                              <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                  <i class="fas fa-search"></i>
                                                </button>
                                              </div>
                                            </div>
                                          </form> 
                                </div>
                                    <div class="card-body">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-hover " >
                                                <thead style="width: 100%">
                                                    <tr>
                                                      <th>Apogee</th>
                                                      <th>Nom</th>
                                                      <th>Prénom</th>
                                                      <th>CNE/MASSAR</th>
                                                      <th>Date de naissance</th>
                                                      <th>Filière</th>
                                                      <th>Section</th>
                                                      <th>Statut</th>
                                                      <th style="width: 15%">Outils</th>

                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @forelse ($etudiant_SA as $etudiant)
                                                    @if (!$etudiant->deleted_at)
                                                    <tr class="table-info">
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
                                                        <span class="badge badge-warning">Non Confirmé</span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                               <button class=" float-right" title="Trashed" ><i class="fa fa-trash  " style="color: red"></i></button>
                                                            </form>
                                                            @if (Auth::user()->isAdmin())
                                                            <span class="float-right" ><a href="{{route('etudiantt.edit',$etudiant->id)}}" title="Editer"><i class="fas fa-edit fa-md ml-1" style="color:rgb(238, 241, 6)"></i></a></span>                                                                                                                     @endif                                                            
                                                            <span class="float-right" ><a href="{{route('etudiant.affiche',$etudiant->id)}}"><i class="fas fa-eye mr-2" style="color: blue"></i></a></span>
                                                            @if ($etudiant->Etat == false)
                                                            <span class="float-right" >
                                                             
                                                                <form action="{{ route('etudiant.confirmation', $etudiant->id)}}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                               <button type="submit" title="Confirmer"><a href=""><i class="fa fa-check mr-2" style="color : green"></i></a></button>
                                                              </form>  
        
                                                            </span>
                                                            @endif
                                                        </td>
                                                        
                                                    </tr>
                                                    @endif
                                                    @empty
                                                    <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe 
                                                        <a class="btn btn-info " colspan="12"  href="{{route('droit.semestre2')}}">Retour</a></td>
                                                    @endforelse
             
                                                    
                                                  </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="p3"> 
                        <div class="row">
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    <div class="card-header ">
                                        <h5 class=" font-weight-bold font-italic float-left">
                                            Droit - S2 - Section B -
                                        </h5>
                                        <form method="GET" action="" class="form-inline ml-3 float-right">
                                            <div class="input-group input-group-sm">
                                              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Apogee,CNE,Nom" aria-label="Search">
                                              <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                  <i class="fas fa-search"></i>
                                                </button>
                                              </div>
                                            </div>
                                          </form> 
                                </div>
                                    <div class="card-body">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-hover " >
                                                <thead style="width: 100%">
                                                    <tr>
                                                      <th>Apogee</th>
                                                      <th>Nom</th>
                                                      <th>Prénom</th>
                                                      <th>CNE/MASSAR</th>
                                                      <th>Date de naissance</th>
                                                      <th>Filière</th>
                                                      <th>Section</th>
                                                      <th>Statut</th>
                                                      <th style="width: 15%">Outils</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @forelse ($etudiant_SB as $etudiant)
                                                    @if (!$etudiant->deleted_at)
                                                    <tr class="table-info">
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
                                                        <span class="badge badge-warning">Non Confirmé</span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                               <button class=" float-right" title="Trashed" ><i class="fa fa-trash  " style="color: red"></i></button>
                                                            </form>
                                                            @if (Auth::user()->isAdmin())
                                                            <span class="float-right" ><a href="{{route('etudiantt.edit',$etudiant->id)}}" title="Editer"><i class="fas fa-edit fa-md ml-1" style="color:rgb(238, 241, 6)"></i></a></span>                                                                                                                     @endif                                                            
                                                            <span class="float-right" ><a href="{{route('etudiant.affiche',$etudiant->id)}}"><i class="fas fa-eye mr-2" style="color: blue"></i></a></span>
                                                            @if ($etudiant->Etat == false)
                                                            <span class="float-right" >
                                                             
                                                                <form action="{{ route('etudiant.confirmation', $etudiant->id)}}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                               <button type="submit" title="Confirmer"><a href=""><i class="fa fa-check mr-2" style="color : green"></i></a></button>
                                                              </form>  
        
                                                            </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @empty
                                                    <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe 
                                                        <a class="btn btn-info " colspan="12"  href="{{route('droit.semestre2')}}">Retour</a></td>
                                                    @endforelse
             
                                                    
                                                  </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="p4"> 
                        <div class="row">
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    <div class="card-header ">
                                        <h5 class=" font-weight-bold font-italic float-left">
                                            Droit - S2 - Section C -
                                        </h5>
                                       
                                          
                                    <form method="GET" action="" class="form-inline ml-3 float-right">
                                            <div class="input-group input-group-sm">
                                              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Apogee,CNE,Nom" aria-label="Search">
                                              <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                  <i class="fas fa-search"></i>
                                                </button>
                                              </div>
                                            </div>
                                          </form> 
                                </div>
                                    <div class="card-body">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-hover " >
                                                <thead style="width: 100%">
                                                    <tr>
                                                      <th>Apogee</th>
                                                      <th>Nom</th>
                                                      <th>Prénom</th>
                                                      <th>CNE/MASSAR</th>
                                                      <th>Date de naissance</th>
                                                      <th>Filière</th>
                                                      <th>Section</th>
                                                      <th>Statut</th>
                                                      <th style="width: 15%">Outils</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @forelse ($etudiant_SC as $etudiant)
                                                    @if (!$etudiant->deleted_at)
                                                    <tr class="table-info">
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
                                                        <span class="badge badge-warning">Non Confirmé</span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                               <button class=" float-right" title="Trashed" ><i class="fa fa-trash  " style="color: red"></i></button>
                                                            </form>
                                                            @if (Auth::user()->isAdmin())
                                                            <span class="float-right" ><a href="{{route('etudiantt.edit',$etudiant->id)}}" title="Editer"><i class="fas fa-edit fa-md ml-1" style="color:rgb(238, 241, 6)"></i></a></span>                                                                                                                     @endif                                                            
                                                            <span class="float-right" ><a href="{{route('etudiant.affiche',$etudiant->id)}}"><i class="fas fa-eye mr-2" style="color: blue"></i></a></span>
                                                            @if ($etudiant->Etat == false)
                                                            <span class="float-right" >
                                                             
                                                                <form action="{{ route('etudiant.confirmation', $etudiant->id)}}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                               <button type="submit" title="Confirmer"><a href=""><i class="fa fa-check mr-2" style="color : green"></i></a></button>
                                                              </form>  
        
                                                            </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @empty
                                                    <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe 
                                                    <a class="btn btn-info " colspan="12"  href="{{route('droit.semestre2')}}">Retour</a></td>
                                                  @endforelse
                                                    
                                                     
                                                    
                                                  </tbody>
                                               
                                            </table>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="p5"> 
                        <div class="row">
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    <div class="card-header ">
                                        <h5 class=" font-weight-bold font-italic float-left">
                                            Droit - S2 - Section D -
                                        </h5>
                                       
                                          
                                    <form method="GET" action="" class="form-inline ml-3 float-right">
                                            <div class="input-group input-group-sm">
                                              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Apogee,CNE,Nom" aria-label="Search">
                                              <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                  <i class="fas fa-search"></i>
                                                </button>
                                              </div>
                                            </div>
                                          </form> 
                                </div>
                                    <div class="card-body">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-hover " >
                                                <thead style="width: 100%">
                                                    <tr>
                                                      <th>Apogee</th>
                                                      <th>Nom</th>
                                                      <th>Prénom</th>
                                                      <th>CNE/MASSAR</th>
                                                      <th>Date de naissance</th>
                                                      <th>Filière</th>
                                                      <th>Section</th>
                                                      <th>Statut</th>
                                                      <th style="width: 15%">Outils</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @forelse ($etudiant_SD as $etudiant)
                                                    @if (!$etudiant->deleted_at)
                                                    <tr class="table-info">
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
                                                        <span class="badge badge-warning">Non Confirmé</span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                               <button class=" float-right" title="Trashed" ><i class="fa fa-trash  " style="color: red"></i></button>
                                                            </form>
                                                            @if (Auth::user()->isAdmin())
                                                            <span class="float-right" ><a href="{{route('etudiantt.edit',$etudiant->id)}}" title="Editer"><i class="fas fa-edit fa-md ml-1" style="color:rgb(238, 241, 6)"></i></a></span>                                                                                                                     @endif                                                            
                                                            <span class="float-right" ><a href="{{route('etudiant.affiche',$etudiant->id)}}"><i class="fas fa-eye mr-2" style="color: blue"></i></a></span>
                                                            @if ($etudiant->Etat == false)
                                                            <span class="float-right" >
                                                             
                                                                <form action="{{ route('etudiant.confirmation', $etudiant->id)}}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                               <button type="submit" title="Confirmer"><a href=""><i class="fa fa-check mr-2" style="color : green"></i></a></button>
                                                              </form>  
        
                                                            </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @empty
                                                    <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe 
                                                    <a class="btn btn-info " colspan="12"  href="{{route('droit.semestre2')}}">Retour</a></td>
                                                  @endforelse
                                                    
                                                     
                                                    
                                                  </tbody>
                                               
                                            </table>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="p6"> 
                        <div class="row">
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    <div class="card-header ">
                                        <h5 class=" font-weight-bold font-italic float-left">
                                            Droit - S2 - Section E -
                                        </h5>
                                       
                                          
                                    <form method="GET" action="" class="form-inline ml-3 float-right">
                                            <div class="input-group input-group-sm">
                                              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Apogee,CNE,Nom" aria-label="Search">
                                              <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                  <i class="fas fa-search"></i>
                                                </button>
                                              </div>
                                            </div>
                                          </form> 
                                </div>
                                    <div class="card-body">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-hover " >
                                                <thead style="width: 100%">
                                                    <tr>
                                                      <th>Apogee</th>
                                                      <th>Nom</th>
                                                      <th>Prénom</th>
                                                      <th>CNE/MASSAR</th>
                                                      <th>Date de naissance</th>
                                                      <th>Filière</th>
                                                      <th>Section</th>
                                                      <th>Statut</th>
                                                      <th style="width: 15%">Outils</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @forelse ($etudiant_SE as $etudiant)
                                                    @if (!$etudiant->deleted_at)
                                                    <tr class="table-info">
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
                                                        <span class="badge badge-warning">Non Confirmé</span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                               <button class=" float-right" title="Trashed" ><i class="fa fa-trash  " style="color: red"></i></button>
                                                            </form>
                                                            @if (Auth::user()->isAdmin())
                                                            <span class="float-right" ><a href="{{route('etudiantt.edit',$etudiant->id)}}" title="Editer"><i class="fas fa-edit fa-md ml-1" style="color:rgb(238, 241, 6)"></i></a></span>                                                                                                                     @endif                                                            
                                                            <span class="float-right" ><a href="{{route('etudiant.affiche',$etudiant->id)}}"><i class="fas fa-eye mr-2" style="color: blue"></i></a></span>
                                                            @if ($etudiant->Etat == false)
                                                            <span class="float-right" >
                                                             
                                                                <form action="{{ route('etudiant.confirmation', $etudiant->id)}}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                               <button type="submit" title="Confirmer"><a href=""><i class="fa fa-check mr-2" style="color : green"></i></a></button>
                                                              </form>  
        
                                                            </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @empty
                                                    <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe 
                                                    <a class="btn btn-info " colspan="12"  href="{{route('droit.semestre2')}}">Retour</a></td>
                                                  @endforelse
                                                    
                                                     
                                                    
                                                  </tbody>
                                               
                                            </table>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="p7"> 
                        <div class="row">
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    <div class="card-header ">
                                        <h5 class=" font-weight-bold font-italic float-left">
                                            Droit - S2 - Section F -
                                        </h5>
                                       
                                          
                                    <form method="GET" action="" class="form-inline ml-3 float-right">
                                            <div class="input-group input-group-sm">
                                              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Apogee,CNE,Nom" aria-label="Search">
                                              <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                  <i class="fas fa-search"></i>
                                                </button>
                                              </div>
                                            </div>
                                          </form> 
                                </div>
                                    <div class="card-body">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-hover " >
                                                <thead style="width: 100%">
                                                    <tr>
                                                      <th>Apogee</th>
                                                      <th>Nom</th>
                                                      <th>Prénom</th>
                                                      <th>CNE/MASSAR</th>
                                                      <th>Date de naissance</th>
                                                      <th>Filière</th>
                                                      <th>Section</th>
                                                      <th>Statut</th>
                                                      <th style="width: 15%">Outils</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @forelse ($etudiant_SF as $etudiant)
                                                    @if (!$etudiant->deleted_at)
                                                    <tr class="table-info">
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
                                                        <span class="badge badge-warning">Non Confirmé</span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                               <button class=" float-right" title="Trashed" ><i class="fa fa-trash  " style="color: red"></i></button>
                                                            </form>
                                                            @if (Auth::user()->isAdmin())
                                                            <span class="float-right" ><a href="{{route('etudiantt.edit',$etudiant->id)}}" title="Editer"><i class="fas fa-edit fa-md ml-1" style="color:rgb(238, 241, 6)"></i></a></span>                                                                                                                     @endif                                                            
                                                            <span class="float-right" ><a href="{{route('etudiant.affiche',$etudiant->id)}}"><i class="fas fa-eye mr-2" style="color: blue"></i></a></span>
                                                            @if ($etudiant->Etat == false)
                                                            <span class="float-right" >
                                                             
                                                                <form action="{{ route('etudiant.confirmation', $etudiant->id)}}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                               <button type="submit" title="Confirmer"><a href=""><i class="fa fa-check mr-2" style="color : green"></i></a></button>
                                                              </form>  
        
                                                            </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @empty
                                                    <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe 
                                                    <a class="btn btn-info " colspan="12"  href="{{route('droit.semestre2')}}">Retour</a></td>
                                                  @endforelse
                                                    
                                                     
                                                    
                                                  </tbody>
                                               
                                            </table>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
               
                
                
                
               
            
              
        </div>
    </div>
</div>
@section('scripts')

@endsection

@endsection