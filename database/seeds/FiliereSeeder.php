<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filieres')->insert(
            [
                'filiere'=>'ECO',
            ]
            );
        DB::table('filieres')->insert(
                [
                    'filiere'=>'DROIT',
                ]
         );
         DB::table('filieres')->insert(
            [
                'filiere'=>'GESTION S6',
            ]
        );
        DB::table('filieres')->insert(
            [
                'filiere'=>'ECO GESTION S6',
            ]
        );
        DB::table('filieres')->insert(
            [
                'filiere'=>'DROIT Public S6',
            ]
     );
        DB::table('filieres')->insert(
        [
            'filiere'=>'DROIT Privée S6',
        ]
    );
    }
}
