@extends('layouts.confirmation')
@section('title')
Centre d'examen
@endsection
@section('content')
<div class="container d-flex justify-content-center mb-2 mt-4">
    <div class="col-md-12">
        <div class="text-info ">
        <h3 class="text-center mt-5">{{$etudiant->Nom}} Vous pouvez choisir librement auprès de quel centre d'examen vous souhaitez vous inscrire et passer un examen  </h3>
        </div>
        <form method="POST" action="">
            @csrf
            <div class="row d-flex justify-content-lg-between">
            @foreach ($villes as $ville)
            
            <button class="btn btn-primary mt-3 btn-lg mb-4 h-100 col-md-5 mx-auto " type="submit" value="{{$ville->id}}">
               
                    
                        
                            <div class="mt-5 text-center mb-5">
                                {{$ville->examen_ville}}
                            </div> 
                        
                   
                
            </button>
            @endforeach
        </div>
        </form>
    </div>
</div>

@endsection