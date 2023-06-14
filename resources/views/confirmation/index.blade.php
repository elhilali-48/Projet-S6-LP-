@extends('layouts.confirmation')
@section('title')
    Page de Confirmation
@endsection
@section('content')


<style>
    .masthead {
  height: 65vh;
  min-height: 300px;
  background-image: url("/img/fssss.png");
  
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

</style>

<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12 text-center">
          <h1 id="tit" class="font-weight-light bold " style="text-shadow: 9px 6px 8px #a3dbec; font-size : 47px;color:#25A2C3; position: absolute;">Espace de Confirmation de présence aux examens</h1>
          {{-- <p class="lead">A great starter layout for a landing page</p> --}}
        </div>
      </div>
    </div>
  </header>
  <section id="sec" class="py-5" style="background-color: #f3f4f5">

  
    @if (session()->has('error'))
      <div class=" text-danger text-center font-wheight-bold" style="">
        <h4 class="err mb-3">{{session()->get('error')}}</h4>
        <h4 class="err">لايوجد أي طالب يطابق هذه البيانات </h4>
      </div>
        @else
      <h3 class="ted text-center bold mt-1  " style="left : 25px; color:#25A2C3;position: absolute;">Veuillez saisir votre code Apogee et de sélectionnez votre date de naissance  
        </h3>
        <h3 class="ara text-center bold   " style="right : 25px; color:#25A2C3; margin-top: 40px;position: absolute;">المرجو إدخال رقم الأبوجي و تاريخ الإزدياد 
        </h3> 
        
   @endif
    <div class="container">

      <div class="row justify-content-center">
          <div id="az"   class="col-md-8 mt-5">
              <div  class="card mt-5 rounded-top" style="border-radius: 10px">
                  <div class="card-header text-center">Tous les champs sont obligatoires
                  </div>
                  
                    @if (session()->has('update'))
                    <div class="alert alert-success mt-1" >
                      <h5><strong>{{session()->get('update')}}
                      
                      </strong></h5>
                    </div>
                    @else
                  
                    @endif
                  
                  
                  <div class="card-body">
                      
                  <form method="POST" action="{{route('etudiant.show')}}">
                          @csrf
                              
                          <div class="form-group row">
                              <label for="apogee" class="col-md-4 col-form-label text-md-right font-weight-bold">Apogee : </label>

                              <div class="col-md-6">
                                  <input id="apogee" type="number" class="form-control @error('apogee') is-invalid @enderror " name="apogee" value="{{ old('apogee') }}"   autofocus placeholder="Saisissez Apogee">

                                  @error('apogee')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="date" class="col-md-4 col-form-label text-md-right font-weight-bold">Date de Naissance : </label>

                              <div class="col-md-6">
                                  <input id="date" type="date" class="form-control @error('date') is-invalid @enderror " name="date" max="2004-01-01" min="1950-01-01"   placeholder="Saisissez votre date de naissance">

                                  @error('date')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-2 d-flex justify-content-center">
                                  <button type="submit" class="btn btn-primary ">
                                      Rechercher
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
              
          </div>
      </div>
      {{-- <button class="idz btn btn-success">hhhh </button> --}}
    </div>
</section>
  <script>
     $('#az').hide();
      $('.ted').hide();
      $('.ara').hide();
      
    $(function(){
     
      $('#tit').mouseover(function(){
        $(this).animate({top: 0},1000);
        // $(this).css('text-shadow','19px 10px 66px').css('color','#05c5ff');
      });
      $('#tit').animate({bottom: 0},1000);
    $('.ted').fadeIn('slow').animate({right: 0}, 900);
    $('.ted').animate({left: 0}, 1000).css('text-shadow','2px,3px,4px');
     
     $('.ara').fadeIn('slow').animate({left: 0}, 900);
     $('.ara').animate({right: 0}, 1000);

       $('#az').slideToggle(1000);

      $('.err').animate({right: 0 },1000);
      $('.err').animate({fontSize: '2em' },"5000").css('margin-bottom',"-40px");
       $(window).scroll(function(){
         $('.ted').animate({left: 20},1000);
         $('.ted').animate({right: 20},1000);
         $('.ara').animate({left: 20},1000);
         $('.ara').animate({right: 20},1000);
       })
    });
//     $(document).ready(function(){
//      $(document).bind("contextmenu",function(e){
//      	 alert('right click disabled');
//         return false;
//     });
// });
   
  </script>


@endsection
