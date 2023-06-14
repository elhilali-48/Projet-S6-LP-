@extends('layouts.appj2')
@section('content')

<!-- Profile Image -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Changer le mot de passe</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Changer le mot de passe</li>
          <li class="breadcrumb-item "><a href="{{route('users.edit',auth()->user()->id)}}">Profile</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="d-flex justify-content-center">
<div class="col-md-10 ">
    @if (session("success"))
        <div class="alert alert-success">
            {{session("success")}}
        </div>
    @endif
    @if (session("error"))
        <div class="alert alert-warning">
            {{session("error")}}
        </div>
    @endif
<div class="card card-primary card-outline ">
    <div class="card-body box-profile">
      
      <ul class="list-group list-group-unbordered mb-3">
      <form action="{{route("users.change_mdp",$user->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mdp_an" class="">Mot de passe ancien </label>
                <input type="password"  class=" form-control @error('mdp_an') is-invalid @enderror" id="mdp_an" name="mdp_an" placeholder="Saissisez votre ancien mot de passe " >
                @error('mdp_an')
                <p class="mt-1 alert alert-danger">{{$message}}</p>
            @enderror
            </div>
            <div class="form-group">
                <label for="mot_passe" class="">Nouveau mot de passe</label>
                <input type="password"  class=" form-control @error('mdp_nv') is-invalid @enderror" id="mot_passe" name="mdp_nv" placeholder="Saissisez le nouveau mo de passe" >
                @error('mdp_nv')
                <p class="mt-1 alert alert-danger">{{$message}}</p>
            @enderror
            </div>
            <div class="form-group">
                <label for="confirm" class="">Confirmer votre mot de passe</label>
            <input type="password"  class="form-control @error('confirm') is-invalid @enderror" id="confirm" name="confirm" placeholder="Répetez votre mot de passe"  >
            @error('confirm')
                 <p class="mt-1 alert alert-danger">{{$message}}</p>
             @enderror
            </div>
            <button class="btn btn-success btn-block mt-2" type="submit" name="submit" ><b>Modifier</b></button>

        </form>
      </ul>

     
    </div>
    <!-- /.card-body -->
  </div>
</div>
</div>
  <!-- /.card -->

    
@endsection