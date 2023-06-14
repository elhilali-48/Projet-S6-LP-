<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Confirmation </title>
    <style>
        table {
  border-collapse: collapse;
  width: 70%;
  margin: 0 auto;
  
}
th{
    height: 50px;
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
    color: rgb(16, 140, 241);
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


<h3>Confirmation de présence à l'examen </h3>
<p>Etudiant(e), <br><br>
    Nous vous remercions pour votre confirmation de présence à l'examen, vous deverez imprimer cette confirmation et la présenter le jour d'examen avec votre carte d'étudiant<br> </p>

    <div class="card-body">
        <div class="table" >
            <table class="table table-striped table-hover " >
                <tr>
                    <th scope="row">Apogee</th>
                    <td>{{$etudiant->first()->Apogee}}</td>
                </tr>
                <tr>
                    <th scope="row">Nom</th>
                    <td>{{$etudiant->first()->Nom}}</td>
                </tr>
                <tr>
                    <th scope="row">Prénom</th>
                    <td>{{$etudiant->first()->Prenom}}</td>
                </tr>
                <tr>
                    <th scope="row">CNE/MASSAR</th>
                    <td>{{$etudiant->first()->CNE}}</td>
                </tr>
                <tr>
                    <th scope="row">Date de naissance</th>
                    <td>{{$etudiant->first()->date_naissance}}</td>
                </tr>
                <tr>
                    <th scope="row">Filère</th>
                    <td>{{$etudiant->first()->filiere}}</td>
                </tr>
                <tr>
                    <th scope="row">Semestre</th>
                    <td>{{$etudiant->first()->semestre}}</td>
                </tr>
                <tr>
                    <th scope="row">Section</th>
                    <td>{{$etudiant->first()->Section}}</td>
                </tr>
               


               
                 
            </table>
        </div>
    </div><br><br>
<p>Nous restons bien entendu à votre disposition pour toute information sur le site web de la faculté <a href="http://www.fsjeste.ma/">Fsjest.ma</a> </p>
<br><br>

<h5>FSJES TETOUAN</h5>
</body>
</html>