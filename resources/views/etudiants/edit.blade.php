@extends('layouts.appj2')

@section('content')
<div class="col-md-12">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show " role='alert' >
      <h5 class="text-center">{{session()->get('success')}}</h5>
      <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&timesbar;</span>
      </button>
    </div>
    @endif
    
</div>
<div class="container d-flex justify-content-center">
<div class="card card-default col-md-12 ">
    
    <div class="card-header">
       <h4 class="font-weight-bold d-flex justify-content-center">Modifier  l'étudiant</h4> 
    </div>
    <div class="card-body ">
        
    <form action="{{route('etudiantt.update',$etudiant->id)}}" method="POST" >
                @csrf
                @method('PUT')
                <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="nom" class="">Nom  : </label>
                        <input class="@error('nom') is-invalid @enderror form-control" id="nom" name="nom" placeholder="Ecrire le nom de l'étudiant" value="{{ $etudiant->Nom}}" >
                            @error('nom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="">Prénom :</label>
                            <input class="@error('prenom') is-invalid @enderror form-control" id="prenom" name="prenom" placeholder="Ecrire le prénom de l'étudiant" value="{{$etudiant->Prenom }}" >
                            @error('prenom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Apogee" class="">Apogée :</label>
                            <input type="number" class="@error('Apogee') is-invalid @enderror form-control" id="Apogee" name="Apogee" placeholder="Ecrire l'Apogée de l'étudiant" value="{{$etudiant->Apogee }}" >
                            @error('Apogee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="CNE" class="">CNE/Massar :</label>
                            <input type="text" class="@error('CNE') is-invalid @enderror form-control" id="CNE" name="CNE" placeholder="Ecrire le code national de l'étudiant" value="{{$etudiant->CNE }}" >
                            @error('CNE')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="CIN" class="">CIN :</label>
                            <input type="text" class="@error('CIN') is-invalid @enderror form-control" id="CIN" name="CIN" placeholder="Ecrire le code d'identité de l'étudiant" value="{{$etudiant->CIN }}" >
                            @error('CIN')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date" class="">Date de naissance :</label>
                            <input id="date" type="date" class="@error('date') is-invalid @enderror form-control " name="date" max="2004-01-01" min="1950-01-01" value="{{$etudiant->date_naissance }}"   placeholder="Saisissez votre date de naissance">

                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="">Email :</label>
                            <input type="email" class="@error('email') is-invalid @enderror form-control" id="email" name="email" placeholder="Ecrire l'email  de l'étudiant" value="{{$etudiant->email }}" >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                        <div class="form-group ">
                            <label>Filiére</label>
                            <select name="filiere" id="options" class="@error('filiere') is-invalid @enderror form-control " style="width: 100%;" >
                                <option value="" disabled selected>Selectionner une filiére</option>
                                @foreach ($filiere as $item)
                                <option value="{{$item->id}}" {{$item->id == $etudiant->filiere_id  ? 'selected' : ''}}>{{$item->filiere}}</option>
                                   
                                @endforeach
                            </select>
                            @error('filiere')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group ">
                            <label>Semestre</label>
                            <select id="choices" name="semestre[]" class="@error('semestre') is-invalid @enderror form-control"  style="width: 100%;">
                            <option value="" disabled selected>Selectionner le semestre</option>  
                            @foreach ($semestre as $item)
                                <option value="{{$item->id}}" 
                                    @if ($etudiant->has_semestre($item->id))
                                    selected
                                    @endif
                                    >{{$item->semestre}}</option>
                            @endforeach
                            </select>
                            @error('semestre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label>Section</label>
                            
                            <select id="section" name="section" class="@error('section') is-invalid @enderror form-control" data-placeholder="Select a State"
                                    style="width: 100%;">
                                    <option value="" disabled selected>Selectionner la section</option>    
                                    <option value="{{$etudiant->Section}}" selected >{{$etudiant->Section}}</option>
                            @foreach (["A","B","C","D","E","F"] as $section)
                            
                            <option value="{{$section}}">{{$section}}</option>
                            @endforeach
                            </select>
                            @error('section')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                        
                </div>
                <div class="d-flex justify-content-center">
                    
                    <a class="btn btn-warning  btn-lg float-right mr-2 " href="javascript:history.back()">Annuler</a>
                    <button type="submit" class="btn btn-success btn-lg ">Modifier</button>
                </div>
                
                </form>
      
    </div>
</div>
</div>

<script>
    // Map your choices to your option value
                // Map your choices to your option value
    var lookup = {
       '1': ["S2","S4"],
       '2': ["S2","S4"],
       '3': ['S6'] ,
       '4': ['S6'],
       '5': ['S6'],
       '6': ['S6'],
    };

    var val ={
        '1': ["1","2"],
       '2': ["1","2"],
       '3': ['3'] ,
       '4': ['3'],
       '5': ['3'],
       '6': ['3'],
    }
    // var slval =$(this).val();
    
    // When an option is changed, search the above for matching choices
    $('#options').on('change', function() {
       // Set selected option as variable
       var selectValue = $(this).val();
    
       // Empty the target field
       $('#choices').empty();
       
       // For each chocie in the selected option
    //    for (i = 0; i < lookup[selectValue].length; i++) {
    //       // Output choice in the target field
    //       $('#choices').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] + "</option>");
    //    }
       if(selectValue == '1'){
        $('#choices').append("<option value='1'>S2</option>");
       
        $('#choices').append("<option value='2'>S4</option>");
       }
       if(selectValue == '2'){
        $('#choices').append("<option value='1'>S2</option>");
        $('#choices').append("<option value='2'>S4</option>");
       }
       if(selectValue == '3'){
        $('#choices').append("<option value='3'>S6</option>");
       }
       if(selectValue == '4'){
        $('#choices').append("<option value='3'>S6</option>");
       }
       if(selectValue == '5'){
        $('#choices').append("<option value='3'>S6</option>");
       }
       if(selectValue == '6'){
        $('#choices').append("<option value='3'>S6</option>");
       }
    });
    

    var section = {
       '1': ['A', 'B',"C"],
       '2': ['A', 'B',"C",'D','E','F'],
       '3': ['A'],
       '4': ['A'],
       '5': ['A'],
       '6': ['A', 'B',"C"],
    };
    
    // When an option is changed, search the above for matching choices
    $('#options').on('change', function() {
       // Set selected option as variable
       var selectValue = $(this).val();
    
       // Empty the target field
       $('#section').empty();
       
       // For each chocie in the selected option
    //    for (i = 0; i < section[selectValue].length; i++) {
    //       // Output choice in the target field
    //       $('#section').append("<option value='" + section[selectValue][i] + "'>" + section[selectValue][i] + "</option>");
    //    }
    if(selectValue == '1'){
        $('#section').append("<option value='A'>A</option>");
        $('#section').append("<option value='B'>B</option>");
        $('#section').append("<option value='C'>C</option>");
       }
       if(selectValue == '2'){
        $('#section').append("<option value='A'>A</option>");
        $('#section').append("<option value='B'>B</option>");
        $('#section').append("<option value='C'>C</option>");
        $('#section').append("<option value='D'>D</option>");
        $('#section').append("<option value='E'>E</option>");
        $('#section').append("<option value='F'>F</option>");
       }
       if(selectValue == '3'){
        $('#section').append("<option value='A'>A</option>");
       }
       if(selectValue == '4'){
        $('#section').append("<option value='A'>A</option>");
       }
       if(selectValue == '5'){
        $('#section').append("<option value='A'>A</option>");
       }
       if(selectValue == '6'){
        $('#section').append("<option value='A'>A</option>");
        $('#section').append("<option value='B'>B</option>");
        $('#section').append("<option value='C'>C</option>");
       }
    });
    
    

    // var sect = {
    //    ["S4"]: ['A', 'B'],
    //    ["S4"]: ['A', 'B','D','C','E'],
       
    // };
    
    // // When an option is changed, search the above for matching choices
    // $('#choices').on('change', function() {
    //    // Set selected option as variable
    //    var selectValue = $(this).val();
    
    //    // Empty the target field
    //    $('#section').empty();
       
    //    // For each chocie in the selected option
    // //    for (i = 0; i < sect[selectValue].length; i++) {
    // //       // Output choice in the target field
    // //       $('#section').append("<option value='" + sect[selectValue][i] + "'>" + sect[selectValue][i] + "</option>");
    // //    }
    // });
          </script>    
@endsection
