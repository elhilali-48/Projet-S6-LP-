@extends('layouts.appj2')
@section('stylesheets')
@endsection
@section('content')
<div class="card card-default">
    <div class="card-header">
      

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> --}}
        
      </div>
      <h4 class="font-weight-bold d-flex justify-content-center">Exporter les listes</h4>
    </div>
    <form method="GET" action="{{action('Exportation_Controller@export_all')}}" class="form-inline ml-3 float-right">
                         
        {{-- <select name="confirm" class="form-control form-control-sm" value="{{ $confirm }} ">
         @foreach (['1','0'] as $con)
         <option @if($con == $confirm) selected @endif value="{{ $con }}">{{ boolval($con) ? 'Confirmé': 'Non confirmé' }}</option>
         @endforeach
        </select> --}}
       
        
      
    <!-- /.card-header -->
    
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mt-3">
            <label>Filiére</label>
            <select name="filiere" id="options" class="form-control form-control-md" style="width: 100%;" value=''>
                <option value="" disabled selected>Selectionner une filiére</option>
                @foreach ($filiere as $item)
                <option value="{{$item->id}}">{{$item->filiere}}</option>
                @endforeach
            </select>

           
          </div>
          <!-- /.form-group -->
          <div class="form-group mt-3">
            <label>Semestre</label>
            <select id="choices" name="semestre" class="form-control form-control-md"  style="width: 100%;">
              <option value="" disabled selected>Selectionner le semestre</option>  
              @foreach ($semestre as $item)
                <option value="{{$item->id}}">{{$item->semestre}}</option>
                @endforeach
             
            </select>
          </div>
          
          <div class="form-group mt-3">
            <label>Etat</label>
           <select name="confirm" class="form-control form-control-md" value=" "  style="width: 100%;">
             @foreach (['1','0'] as $con)
             <option  value="{{ $con }}">{{ boolval($con) ? 'Confirmé': 'Non confirmé' }}</option>
             @endforeach
             </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 ">
          <div class="form-group mt-3">
            <label>Section</label>
            
            <select id="section" name="section" class="form-control form-control-md" data-placeholder="Select a State"
                    style="width: 100%;">
                    <option value="" disabled selected>Selectionner la section</option>    
             @foreach (["A","B","C","D","E","F"] as $section)
             
             <option value="{{$section}}">{{$section}}</option>

             @endforeach
            </select>
          </div>
          <!-- /.form-group -->
         
          <!-- /.form-group -->
        </div>
        <div class="col text-center mt-3">
            <button class="btn btn-success "  type="submit">
              <i class="fa fa-download" aria-hidden="true"></i>
                Export PDF
            </button>
        </div>
    </form>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      {{-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
      the plugin. --}}
    </div>
  </div>
  <script>
    // Map your choices to your option value
                // Map your choices to your option value
    var lookup = {
       '1': ['S2', 'S4'],
       '2': ['S2', 'S4'],
       '3': ['S6'],
       '4': ['S6'],
       '5': ['S6'],
       '6': ['S6'],
    };
    
    // When an option is changed, search the above for matching choices
    $('#options').on('change', function() {
       // Set selected option as variable
       var selectValue = $(this).val();
    
       // Empty the target field
       $('#choices').empty();
       
       // For each chocie in the selected option
       for (i = 0; i < lookup[selectValue].length; i++) {
          // Output choice in the target field
          $('#choices').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] + "</option>");
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
       for (i = 0; i < section[selectValue].length; i++) {
          // Output choice in the target field
          $('#section').append("<option value='" + section[selectValue][i] + "'>" + section[selectValue][i] + "</option>");
       }
    });
    var fil = $('#options').val();
    if($('#options').val()==='ECO'){
      var sect = {
      //  ["S4"]: ['A', 'B'],
       "S4": ['A', 'B','D','C','E'],
      
    };
    
    // When an option is changed, search the above for matching choices
    $('#choices').on('change', function() {
       // Set selected option as variable
       var selectValue = $(this).val();
    
       // Empty the target field
       $('#section').empty();
       
       // For each chocie in the selected option
       for (i = 0; i < sect[selectValue].length; i++) {
          // Output choice in the target field
          $('#section').append("<option value='" + sect[selectValue][i] + "'>" + sect[selectValue][i] + "</option>");
       }
    });
    }
   
          </script>
@endsection

