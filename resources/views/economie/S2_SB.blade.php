@extends('layouts.appj2')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
                <nav class="nav nav-tabs">
                <a class="nav-item nav-link" href="{{route('economie.semestre2')}}">Semestre 2</a>
                    <a class="nav-item nav-link" href="{{route('semestre2.sectionA')}}" >Section A</a>
                    <a class="nav-item nav-link active" >Section B</a>
                    <a class="nav-item nav-link" href="{{route('semestre2.sectionC')}}" >Section C</a>
                </nav>
                {{-- <div class="tab-content text-center"> --}}
                   
                    {{-- <div class="tab-pane" id="p2"> --}}
                        <div class="row">
                            <div class="col-md-12 mt-4 ">
                                <div class="card bg-light  text-black" style="border-radius: 7px">
                                    <div class="card-header text-enter">
                                        <h5 class=" font-weight-bold font-italic">
                                            Economie - S2 - Section B -
                                        </h5>
                                        <form method="GET" action="{{route('semestre2.sectionB')}}" class="form-inline ml-3 float-right">
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
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @forelse ($etudiant_SB as $etudiant)
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
                                                    </tr>
                                                    @empty
                                                       Aucune Confirmation Existe 
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

@endsection