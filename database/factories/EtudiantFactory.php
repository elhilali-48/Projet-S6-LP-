<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Etudiant;
use Faker\Generator as Faker;
use phpDocumentor\Reflection\Types\Nullable;

$factory->define(Etudiant::class, function (Faker $faker) {
    return [
        'Nom'=>$faker->lastName,
        'Prenom'=>$faker->firstName($gender ='male'|'female'),
        'filiere_id'=>$faker->numberBetween($min=1,$max=6),
        'Section'=>$faker->randomElement($array = array ('A','B','C','D','E',"F")),
        'Apogee'=>$faker->numberBetween($min= 14000000, $max = 19700000 ),
        'CNE'=>$faker->regexify('[A-Z][1-68][0-9]{8}'),
        'CIN'=>$faker->regexify('[A-Z][1-68][0-9]{8}'),
        'date_naissance'=>$faker->date($format = 'Y-m-d', $max = '2001-01-01'),
        'email'=>$faker->safeEmail,
        

    ];
});
