@extends('layouts.confirmation')
    @section('title')
    Page de Confirmation
    @endsection
@section('content')

<div class="container d-flex justify-content-center mb-2 mt-4" style="width: 100%; height:650px">
    <div class="col-md-12 mt-2" > 
        @if (session()->has('update'))
            <div  id="alert" class="alert alert-success mt-1" >
                <h5>{{session()->get('update')}}</h5>
            </div>
        @else
        @endif
    </div>
    <div  id="card"   class="col-md-8 mt-5">
        <div style="box-shadow: 2px 5px 3px 2px  #94D6F5 " class="card border border-primary border-3 rounded-bottom " >
            <div class="card-header " style="background-color:#94D6F5">
                <h3 class="text-center font-weight-bold font-italic pt-2"> Information d'etudiant</h3> <span class=" text-warning float-right font-weight-bold">{{boolval($etudiant->first()->Etat) ? '':'Non Confirmé'}}</span>
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
                    
                    
                    </tbody>
                </table>
             </div>
        </div> 
        
       

    
    </div>
    <div id="message">
       
        @if ($etudiant->first()->Etat)
        <div id="msg" class="text-info  text-center mt-2"><h3 id="mm">Votre confirmation au examen est bien enregistré</h3> </div>
        <form action="{{route('centre.examen',$etudiant->first()->id)}}" method="POST">
            @csrf
            
            <div class="d-flex justify-content-center"> <button  class="btn btn-info btn-lg" type="submit">Je Choisis le centre d'examen </button></div>

        </form>
        @else
            <form action="{{route('etudiant.confirm',$etudiant->first()->id)}}"  method="POST" >

                @csrf
                 
                    <div class="col-md-12 d-flex justify-content-center">
                        <button class=" btn btn-success btn-lg  mt-3 mb-3">
                            Je Confirme ma présence
                        </button>
                    </div>
            </form>
        @endif   
      
    </div>
    {{-- <div >
        <div class="card">
            
                @foreach ($ville as $v)
                    <ul class="list-group">
                    <li class="list-group-item">{{$v->examen_ville}}</li>
                    </ul>
                @endforeach
               
        </div> 
    </div> --}}
</div>


    
<script >
     $('#card').hide();
     $('#message').hide();
     
  $(function(){
    $("#card").fadeIn().css({bottom:1000,position:'absolute'}).animate({bottom:300}, 800, function() {
    //callback
});
$("#message").fadeIn().css({top:1000,position:'absolute'}).animate({top:620}, 850, function() {
    //callback
});
$('#alert').fadeOut(9000,function(){
    $("#mm").css("color", "#22BB33").animate({fontSize:'2em'},1000);

});
  });
 
  </script> 
@endsection