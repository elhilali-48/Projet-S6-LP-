<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
         $this->call(FiliereSeeder::class);
         $this->call(SemestreSeeder::class);
        //  $this->call(SectionSeeder::class);
         $this->call(EtudiantSeeder::class);
        $this->call(Etudiant_SemestreSeeder::class);
    }
}
