
@component('mail::message')

<h2 class="intro" style="color:#19c552 ;
text-justify: auto;
font-weight: bold;
justify-content: center;
font-style: italic;"> Votre Confirmation est bien enregistrée</h2>
{{-- <a href="{{ url('/home') }}" class="brand-link">
    <img src="/img/logo.png" alt="FSJES TETOUAN Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    
  </a> --}}
  <p>Bonjour <span style="font-style: bold">{{$etudiant->Nom}}</span>,
    Vous avez bien confirmé votre présence à l'examen voci les informations correspond à votre confirmation</p>
 <table class="table bg-ligh">
        <tbody>
        <tr>
            <th scope="row">Nom</th>
            <td>{{$etudiant->Nom}}</td>
        </tr>
        <tr>
            <th scope="row">Prénom</th>
            <td>{{$etudiant->Prenom}}</td>
        </tr>    
        <tr>
            <th scope="row">Apogee</th>
            <td>{{$etudiant->Apogee}}</td>
        </tr>
        <tr>
            <th scope="row">CNE/MASSAR</th>
            <td>{{$etudiant->CNE}}</td>
        </tr> 
        <tr>
            <th scope="row">Filière</th>
            <td>{{$etudiant->filiere_id}}</td>
        </tr>
        </tbody>
    </table><br>
{{-- @component('mail::button', ['url' =>  "action('confirmation.pdf',$etudiant->id)"])
Imprimer Confirmation
@endcomponent --}}
<style>
button {
  background-color: rgb(69, 204, 245);
  position: absolute;
  top: 50%;
  left: 25%;
  
    color: rgb(20, 20, 20);
  font-size: 15px;
  padding: 12px 28px;
  border-radius: 4px;
  border: 2px solid #fcfffc;
  transition-duration: 0.4s;
}
button:hover {
  background-color: lightgreen;
}
a{
    text-decoration: none;
    color: aliceblue;
}

</style>
<button><a href="{{route('confirmation.pdf',$etudiant->id)}}">Imprimer confirmation</a></button>



<h4>Vous deverez imprimer la confirmation ci-dessus et de la présenter avec la carte d'étudiant au jour d'examen </h4>
Merci et à très bientot,<br><br>
FSJES TETOUANE
@endcomponent 
