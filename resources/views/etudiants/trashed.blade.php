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
            @if (session()->has('delete'))
          <div class="alert alert-danger alert-dismissible fade show " role='alert' >
            <h5 class="text-center">{{session()->get('delete')}}</h5>
            <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&timesbar;</span>
            </button>
          </div>
          @endif
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show " role='alert' >
              <h5 class="text-center">{{session()->get('success')}}</h5>
              <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&timesbar;</span>
              </button>
            </div>
            @endif
            <div class="col-md-12 mt-4 ">
                <div class="card bg-light  text-black" style="border-radius: 7px">
                    <div class="card-header text-enter ">
                        <h5 class="font-weight-bold font-italic">Etudiant : Supprimer (Trashed)
                          <div class="form-inline ml-3  float-right">
                            @if ($trashed->count()>0)
                            <a href="{{route('trashed.restoreall')}}" ><button class="btn btn-success btn-md float-right ml-1">Restorer Tous </button></a>
                            @endif
                         </div>
                        </h5>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-striped table-hover " >
                                <thead style="width: 100%">
                                    <tr class="text-center">
                                      <th>Apogee</th>
                                      <th>Nom</th>
                                      <th>Prénom</th>
                                      <th>CNE/MASSAR</th>
                                      {{-- <th>Date de naissance</th> --}}
                                      <th>Section</th>
                                      <th>Date de suppression</th>
                                      <th>Status</th>
                                      <th style="width: 15%">Outils</th>
                                    </tr>
                                  </thead>
                                  <tbody>
        
                                    @forelse ($trashed as $etudiant)
                                    <tr class="table-info text-center">
                                    <th scope="row">{{$etudiant->Apogee}}</th>
                                        <td>{{$etudiant->Nom}}</td>
                                        <td>{{$etudiant->Prenom}}</td>
                                        <td>{{$etudiant->CNE}}</td>
                                        {{-- <td>{{$etudiant->date_naissance}}</td> --}}
                                        {{-- <td>{{$etudiant->semestre}}</td> --}}
                                        <td class="text-center">{{$etudiant->Section}}</td>
                                        <td>{{$etudiant->deleted_at}}</td>
                                        <td>
                                         @if ($etudiant->Etat)
                                            <span class="badge badge-success">Confirmé</span>
                                        @else
                                        <span class="badge badge-warning text-center">Non Confirmé</span>
                                        @endif
                                        </td>
                                        <td style="width: auto">
                                            <form action="{{route('etudiantt.destroy',$etudiant->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                               <button class="btn btn-danger btn-xs float-right ml-2" >Delete</button>
                                              
                                               </form>
                                               <a href="{{route('trashed.restore',$etudiant->id)}}" ><button class="btn btn-success btn-xs float-right ml-1">Restore</button></a>
                                        
                                      </td>
                                    </tr>
                                    @empty
                                      <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe </td>
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

@endsection