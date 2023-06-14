@extends('layouts.appj2')
@section('content')
    
<div class="container d-flex justify-content-center">
    <div class="col-md-10 ">
        @if (session()->has('email'))
        <div class=" text-success text-center font-wheight-bold" >
        <h5>{{session()->get('email')}}</h5>
         </div>
         @endif
        <div style="border-radius: 20px" class="card " >
                   
            <div class="card-header" style="background-color: #44f1f7a6; border-top-right-radius: 20px;border-top-left-radius: 20px;">
                
                <span class=" text-warning float-right font-weight-bold d-flex" >{{boolval($etudiant->first()->Etat) ? '':'Non Confirmé'}}</span>
                <h3 class="text-center font-weight-bold font-italic pt-2"><i class="fa fa-graduation-cap fa-fw " aria-hidden="true"></i> Information d'etudiant </h3> 
            </div>
            <div class="card-body">

                <table class="table bg-ligh table-striped text-center">
                    {{-- <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead> --}}
                    <tbody>
                    <tr>
                        <th scope="row">Nom</th>
                        <td>{{$etudiant[0]->Nom}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Prénom</th>
                        <td>{{$etudiant->first()->Prenom}}</td>
                    </tr>    
                    <tr>
                        <th scope="row">Apogee</th>
                        <td>{{$etudiant->first()->Apogee}}</td>
                    </tr>
                    <tr>
                        <th scope="row">CNE/MASSAR</th>
                        <td>{{$etudiant->first()->CNE}}</td>
                    </tr> 
                    <tr>
                        <th scope="row">Filière</th>
                        <td>{{$etudiant->first()->filiere}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Semestre</th>
                        <td>
                            @foreach ($etudiant as $item)
                            {{$item->semestre}}<br>
                            @endforeach
                            
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Section</th>
                        <td>
                            @foreach ($etudiant as $item)
                            {{$item->Section}}
                            @endforeach
                            
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td>
                            {{$etudiant->first()->email}}
                        </td>
                    </tr>
                    @if ($etudiant->first()->Etat)
                    <tr>
                        <th scope="row">Date de confirmation </th>
                        <td>
                            {{$etudiant->first()->confirmation_verified_at}}
                        </td>
                    </tr>
                    @endif

                    
                    </tbody>
                </table>
             </div>
        </div> 
        @if ($etudiant->first()->Etat)
        <div class="text-info bold text-center mt-2"><h3>Etudiant Confirmé</h3> </div>

        @else


    <form action="{{route('etudiant.rappel',$etudiant->first()->id)}}"  method="POST" >

        @csrf
        @method('PUT')  
            <div class="col-md-12 d-flex justify-content-center">
                <button class="btn btn-success btn-lg  mt-3 ">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>

                    Rappeler
                </button>
            </div>
        </form>
        @endif  
    </div>
</div>

@endsection