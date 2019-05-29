<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'role' => 'admin',
                'password' => '$2y$10$EpJHtieMNFdxME8oJAl/Aey8MNRNrEhJI2ldew5s563l9R7AImPY.',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'joyce',
                'email' => 'joyce@gmail.com',
                'email_verified_at' => NULL,
                'role' => 'user',
                'password' => '$2y$10$VPu9VSuGd1OT2Kk.SzCuGOPe96uEGK7iEHs6eP/rh1IXMyxnPS0lK',
                'remember_token' => NULL,
                'created_at' => '2019-05-27 05:53:37',
                'updated_at' => '2019-05-27 05:53:37',
            ),
        ));
        
        
    }
}