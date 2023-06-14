@extends('layouts.app')
@section('stylesheets')
<link rel="stylesheet" href="page/responsive.css"> 
<script src="/adminLTE/plugins/jquery/jquery.min.js">
</script> 
@endsection
@section('content')
<div class="container" style="width: 700px;">
    <div class="row justify-content-center" >
        <div class="col-md-10 "style = "margin-top: 200px">
            <div id="box" class="card rounded-5" style="border-radius: 10px" >
                <div class="card-header text-center text-uppercase "><h3><b>{{ __('Login') }}</b></h3></div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button  type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
     $('#box').hide();
    $(function(){
       
    $('#box').fadeIn().css({position:'absolute',top:-900,width:550}).animate({top:00}, 850, function() {
    //callback
});
   
    $("#message").fadeIn().css({top:1000,position:'absolute'}).animate({top:620}, 850, function() {
    //callback
});
});
 

</script>
@endsection
