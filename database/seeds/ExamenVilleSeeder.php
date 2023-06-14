<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamenVilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('examen_villes')->insert(
            [
                'examen_ville'=>'TETOUAN',
            ]
        );
        DB::table('examen_villes')->insert(
            [
                'examen_ville'=>'AL HOCEIMA',
            ]
        );
        DB::table('examen_villes')->insert(
            [
                'examen_ville'=>'CHEFCHAOUEN',
            ]
        );
        DB::table('examen_villes')->insert(
            [
                'examen_ville'=>'OUAZANE',
            ]
        );
    }
}
