<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Economie : Confirmé</title>
    <style>
        table {
  border-collapse: collapse;
  width: 100%;
  
}
th{
    height: 25px;
    text-align: center;
}
tr:hover {background-color: #f5f5f5;}
tr:nth-child(even) {background-color: #f2f2f2;}

table, th, td {
  border: 1px solid black;
  text-align: center;
}
.head{
    background-color: rgb(35, 149, 255);
    color: white;
}
img{
    opacity: .8;width: 100px; height:100px;
    /* display: block; */
  margin-left: 300px;
  
  
}
.fsjes{
    text-align: center;
    color: blue;
    font-style: italic;
}
.date{
  text-align: right;
}


    </style>
</head>
<body>
     <p class="date" >{{date('Y-m-d H:i:s')}}</p>
    <img src="../public/img/logo.png" alt="Logo FSJES" >
    <h2 class="fsjes">  FSJES TETOUAN</h2>
<b >Filiére<b> : <b>{{$economie->first()->filiere}}</b>

<h3>Nombre d'étudiant {{boolval($economie->first()->Etat ) ? 'confirmé' : 'non confirmé'}} : {{$count}}</h3>

{{-- <h3>Filère : {{$economie[0]->filiere}}</h3> --}}


    <div class="card-body">
      
        <div class="table" >
          
            <table class="table table-striped table-hover " >
                <thead class="head">
                    <tr>
                      <th>Apogee</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>CNE/MASSAR</th>
                      <th>Date de naissance</th>
                      <th>Semestre</th>
                      <th>Section</th>
                      <th>Status</th>
                      
                    </tr>
                  </thead>
                  <tbody >

                    @forelse ($economie as $etudiant)
                    <tr class="table-info">
                    <th scope="row">{{$etudiant->Apogee}}</th>
                        <td>{{$etudiant->Nom}}</td>
                        <td>{{$etudiant->Prenom}}</td>
                        <td>{{$etudiant->CNE}}</td>
                        <td>{{$etudiant->date_naissance}}</td>
                        <td>{{$etudiant->semestre}}</td>
                        <td>{{$etudiant->Section}}</td>
                        <td>
                         @if ($etudiant->Etat)
                            <span class="badge badge-success">Confirmé</span>
                        @else
                        <span class="badge badge-warning">Non Confirmé</span>
                        @endif
                        </td>
                       
                    
                    </tr>
                    @empty
                      <td colspan="12" class="text-danger text-center"> Aucune Etudiant Existe </td>
                    @endforelse

                    
                  </tbody>
            </table>
        </div>
    </div>

</body>
</html>