@extends('layouts.appj2')
@section('content')
<div class="container">
              @if (session()->has('success'))
              <div class="alert alert-success text-center">
            {{session()->get('success')}}
            </div>
            @endif
                 
                 
                 <div class="card " style="margin-top: 20px">
                   <div class="card-header">
                  <h1 class="text-center text-primary">Listes des utilisateurs</h1>
                   </div>
                   
                    <div class="card-body">


                       <table class="table">
                        
                        <thead class="text-center">
                          <tr>
                            <th scope="col">id</th>
                            <th scope="col">image</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">role</th>
                            <th scope="col">Date Création</th>
                            <th scope="col" style="width: 21%">Permission</th>
                          </tr>
                        </thead>
                       
                        <tbody>
                          @foreach ($user as $user)
                          <tr>
                            
                            <th scope="row">{{$user->id}}</th>
                          <th >
                            @if ($user->image)
                            <img src="{{asset('storage/'.$user->image)}}" style="width: 50px; height:50px; border-radius:50%">
                            @else
                            <img src="{{$user->getAvatar()}}" style="width: 50px; height:50px; border-radius:50%">
                            @endif
                            
                          </th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                              
                              @if (! $user->isAdmin())

                            <form action="{{route('users.make', $user->id)}}" method="POST">
                                       @csrf
                                      <button type="submit" class="btn btn-success btn-sm float-left">Make Admin</button>
                            </form>  
                            <form action="{{ route('users.delete', $user->id)}}" method="POST">
                                      @csrf
                                      @method("DELETE")
                                     <button type="submit" class="btn btn-danger btn-sm float-right">Supprimer</button>
                            </form>  
                                
                               @elseif($user->isAdmin()) 
                                    @if ($user->name == 'elhilali' )
                                      <button type="submit" class="badge badge-primary ml-4">Admin Principale</button>
                                    @else
                                     <form action="{{route('users.make', $user->id)}}" method="POST">
                                      @csrf
                                     <button type="submit" class="btn btn-primary btn-sm float-left">Rendre User</button>
                                    </form>  
                                    <form action="{{ route('users.delete', $user->id)}}" method="POST">
                                      @csrf
                                      @method("DELETE")
                                     <button type="submit" class="btn btn-danger btn-sm float-right">Supprimer</button>
                                    </form> 
                                    @endif
                
                              @endif
                              

                            </td>
                          </tr>
                          @endforeach

                      </table>

                  </div>

                </tbody>
                {{-- @empty
                <div class=" text-secondary">Aucun Utilisateur Trouvé</div> --}}

                
</div>

    
@endsection