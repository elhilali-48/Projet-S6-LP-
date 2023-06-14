@component('mail::message')
<h2 class="intro" style="color:#1933c5 ;
text-justify: auto;
font-weight: bold;
justify-content: center;
font-style: italic;"> Confirmez Votre présence à l'examen !!</h2>

<p>Bonjour <span style="font-weight: bolder">{{$etudiant->Nom}}</span>,
    nous vous remercions de bien vouloir nous confirmer votre présence à l'examen
    <br>En cliquant sur le button ci-dessous vous pouvez accéder à la page pour confirmer votre présence  </p>
@component('mail::button', ['url' => 'http://127.0.0.1:8000/confirmation'] )
Confirmer 
@endcomponent

Merci,<br>
FSJES TETOUAN
@endcomponent
