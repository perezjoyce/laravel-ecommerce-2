<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'status_id' => 1,
                'total' => '1220.00',
                'created_at' => '2019-05-27 05:54:32',
                'updated_at' => '2019-05-28 06:36:09',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'status_id' => 3,
                'total' => '50.00',
                'created_at' => '2019-05-27 05:55:28',
                'updated_at' => '2019-05-28 06:37:08',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 2,
                'status_id' => 2,
                'total' => '40.00',
                'created_at' => '2019-05-27 05:56:05',
                'updated_at' => '2019-05-28 06:33:10',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'status_id' => 1,
                'total' => '0.00',
                'created_at' => '2019-05-28 10:28:37',
                'updated_at' => '2019-05-28 10:28:37',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'status_id' => 1,
                'total' => '0.00',
                'created_at' => '2019-05-28 10:28:57',
                'updated_at' => '2019-05-28 10:28:57',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'status_id' => 1,
                'total' => '0.00',
                'created_at' => '2019-05-28 10:29:54',
                'updated_at' => '2019-05-28 10:29:54',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'status_id' => 1,
                'total' => '0.00',
                'created_at' => '2019-05-28 10:30:15',
                'updated_at' => '2019-05-28 10:30:15',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}