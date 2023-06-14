<?php

use Illuminate\Database\Seeder;

class SemestreEtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Semestre_Etudiant::class,100)->create();
    }
}
