@extends('layouts.appj2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div> --}}
            <div class="row text-center">
                <div class="col-md-4 ">
                    <div class="card bg-success   mb-1 " style="border-radius: 7px ">
                        <div class="card-header">
                            
                            <h5 class="font-weight-bold">Total de confirmation</h5>
                           
                        </div>
                        <div class="card-body ">
                           <b style="font-size: 25px" > {{$total}}</b>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card bg-info text-black mb-1 " style="border-radius: 7px">
                        <div class="card-header">
                            
                            <h5 class="font-weight-bold">Total des étudiants</h5>
                        </div>
                        <div class="card-body">
                           <b style="font-size: 25px"> {{$etudiant}}</b>
                        </div>
                    </div>
                </div>
                <div class="col-md-4  ">
                    <div class="card bg-warning text-white mb-1" style="border-radius: 7px">
                        <div class="card-header">
                            <h5 class="font-weight-bold text-white">Les étudiants non confirmés</h5>
                        </div>
                        <div class="card-body text-white">
                           
                            <b style="font-size: 25px">  {{$nconfirm}}</b>
                          
                        </div>
                    </div>
                </div>
 
                <div class="col-md-8 mt-4 ">
                    <div class="card bg-light  text-black" style="border-radius: 7px">
                        {!! $chart->container() !!}
                    </div>
                </div>
                <div class="col-md-4 mt-4 ">
                    <div class="card bg-light  text-black" style="border-radius: 7px">
                        {!! $chart2->container() !!}
                    </div>
                </div>

                <div class="col-md-12 mt-4 ">
                    <div class="card bg-light  text-black" style="border-radius: 7px">
                        <div class="card-header text-center"><h5 class="font-weight-bold">Confirmations récentes
                        </h5></div>
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
                                          <th>Date de confirmation</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @forelse ($last_confirmation as $etudiant)
                                        <tr class="table-info">
                                        <th scope="row">{{$etudiant->Apogee}}</th>
                                            <td>{{$etudiant->Nom}}</td>
                                            <td>{{$etudiant->Prenom}}</td>
                                            <td>{{$etudiant->CNE}}</td>
                                            <td>{{$etudiant->date_naissance}}</td>
                                            <td>{{$etudiant->filiere}}</td>
                                            <td>{{$etudiant->Section}}</td>
                                            <td>{{$etudiant->confirmation_verified_at}}</td>
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
            {!! $chart->script() !!}
            {!! $chart2->script() !!}
        </div>
    </div>
</div>
@endsection
