<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Semestre_Etudiant;
use Faker\Generator as Faker;



$factory->define(Semestre_Etudiant::class, function (Faker $faker) {
    $etudiant = factory(App\Etudiant::class)->create();
    return [
        
            'etudiant_id'=>$etudiant->id,
            'semestre_id'=>$faker->numberBetween($min = 1, $max=3)
    ];
});
