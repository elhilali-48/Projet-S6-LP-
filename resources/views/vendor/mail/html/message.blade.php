@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
<img  src="http://www.fsjeste.ma/wp-content/uploads/2017/09/petit-logo-fsjest.jpg" style="opacity: .8 ; border-radius : 10%; height: auto; display: block;
margin-left: auto;
margin-right: auto;
width: 30%;">
<p class="tt"><b>FSJES TETOUAN</b></p>
 
 
 {{-- <table class="table">
        <tbody>
        <tr>
            <th scope="row">Nom</th>
            <td>ELhilali</td>
        </tr>
        <tr>
            <th scope="row">Prénom</th>
            <td>ELhilali</td>
        </tr>    
        <tr>
            <th scope="row">Apogee</th>
            <td>ELhilali</td>
        </tr>
        <tr>
            <th scope="row">CNE/MASSAR</th>
            <td>ELhilali</td>
        </tr> 
        <tr>
            <th scope="row">Filière</th>
            <td>ELhilali</td>
        </tr>
        </tbody>
    </table> --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} FSJES TETOUAN 
@endcomponent
@endslot
@endcomponent
