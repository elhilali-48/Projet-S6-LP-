@extends('layouts.appj2')
@section('content')

<!-- Profile Image -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('users.change',$user->id)}}">Changer le mot de passe</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="d-flex justify-content-center">
<div class="col-md-10 ">
    
<div class="card card-primary card-outline ">
    <div class="card-body box-profile">
      <div class="text-center">
    
             @if ($user->image)
                <img class="profile-user-img img-fluid img-circle" src="{{asset('storage/'.$user->image)}}" style="width: 200px; height:200px; border-radius:50%">
                @else
                <img class="profile-user-img img-fluid img-circle" src="{{$user->getAvatar()}}" style="width: 50px; height:50px; border-radius:50%">
                @endif
      </div>

      <h3 class="profile-username text-center">{{$user->name}}</h3>

      <p class="text-muted text-center">{{$user->about}}</p>

      <ul class="list-group list-group-unbordered mb-3">
        <form action="{{route("users.update",$user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="nom" class="">Name</label>
                <input  class=" form-control" id="nom" name="name" placeholder="Taper Le nom de " value="{{$user->name}}" >

            </div>
            <div class="form-group">
                <label for="email" class="">E-mail</label>
                <input  class=" form-control" id="email" name="email" placeholder="Taper l'email" value="{{$user->email}}" >

            </div>
            <div class="form-group">
                <label for="email" class="">about</label>
            <input  class="form-control" id="about" name="about" placeholder="" value="{{$user->about}}" >

            </div>
            {{-- <div class="form-group">
                <label for="image" class="">Image Actuel : </label><br>
                @if ($user->image)
                <img src="{{asset('storage/'.$user->image)}}" style="width: 200px; height:200px; border-radius:50%">
                @else
                <img src="{{$user->getAvatar()}}" style="width: 50px; height:50px; border-radius:50%">
                @endif
            </div> --}}
            <div class="form-group">
                <label for="image" class="">Modifier Image :  </label><br>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
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


{{-- <div class="card card-default">
    <div class="card-header">Edite Profile</div>
    <div class="card-body">
    <form action="{{route("users.update",$user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="nom" class="">Name</label>
                <input  class=" form-control" id="nom" name="name" placeholder="Taper Le nom de " value="{{$user->name}}" >

            </div>
            <div class="form-group">
                <label for="email" class="">E-mail</label>
                <input  class=" form-control" id="email" name="email" placeholder="Taper l'email" value="{{$user->email}}" >

            </div>
            <div class="form-group">
                <label for="email" class="">about</label>
            <input  class="form-control" id="about" name="about" placeholder="" value="{{$user->about}}" >

            </div>
            <div class="form-group">
                <label for="image" class="">Image Actuel : </label><br>
                @if ($user->image)
                <img src="{{asset('storage/'.$user->image)}}" style="width: 200px; height:200px; border-radius:50%">
                @else
                <img src="{{$user->getAvatar()}}" style="width: 50px; height:50px; border-radius:50%">
                @endif
            </div>
            <div class="form-group">
                <label for="image" class="">Modifier Image :  </label><br>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                 <p class="mt-1 alert alert-danger">{{$message}}</p>
             @enderror
            </div>

            <button class="btn btn-success mt-2" type="submit" name="submit" >Modifier</button>

        </form>
    </div>
</div> --}}
    
@endsection