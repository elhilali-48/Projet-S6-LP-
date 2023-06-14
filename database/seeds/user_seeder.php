<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email','elhilali.abdelouahab@gmail.com')->first();
        if(!$user){
            User::create([
                'name'=>'elhilali',
                'email'=>'elhilali.abdelouahab@gmail.com',
                'password'=>Hash::make('123hilali'),
                'role'=>"admin",
            ]);
        }
    }
}
