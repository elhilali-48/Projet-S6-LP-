<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semestres')->insert(
            [
                'semestre'=>'S2 ',
                // 'filiere_id'=>'1',
                // 'section'=>'A,B,C'
            ]
        ); 
        // DB::table('semestres')->insert(
        //     [
        //         'semestre'=>'S2 Droit ',
        //         // 'filiere_id'=>'2',
        //         // 'section'=>'A,B,C,D,E,F'
        //     ]
        // );
        DB::table('semestres')->insert(
                [
                    'semestre'=>'S4',
                    // 'filiere_id'=>'1',
                    // 'section'=>'A,B'
                ]
                ); 
        // DB::table('semestres')->insert(
        //             [
        //                 'semestre'=>'S4 Droit',
        //                 // 'filiere_id'=>'2',
        //                 // 'section'=>'A,B,C,D,E'
        //             ]
        //  ); 
         DB::table('semestres')->insert(
            [
              'semestre'=>'S6 ',
            //   'filiere_id'=>'3',
            //   'section'=>'A'
            ]
         );
        //  DB::table('semestres')->insert(
        //     [
        //       'semestre'=>'S6 ECO GESTION',
        //     //   'filiere_id'=>'4',
        //     //   'section'=>'A'
        //     ]
        //  );
        //  DB::table('semestres')->insert(
        //     [
        //       'semestre'=>'S6 DROIT P',
        //     //   'filiere_id'=>'5',
        //     //   'section'=>'A'
        //     ]
        //  );
        //  DB::table('semestres')->insert(
        //     [
        //       'semestre'=>'S6 DROIT V',
        //     //   'filiere_id'=>'6',
        //     //   'section'=>'A,B,C'
        //     ]
        //  );
                    
    }
}
