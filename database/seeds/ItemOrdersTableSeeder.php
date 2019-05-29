<?php

use Illuminate\Database\Seeder;

class ItemOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_orders')->delete();
        
        \DB::table('item_orders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 10,
                'order_id' => 1,
                'quantity' => 11,
                'created_at' => '2019-05-27 05:54:32',
                'updated_at' => '2019-05-27 05:54:32',
            ),
            1 => 
            array (
                'id' => 2,
                'item_id' => 12,
                'order_id' => 1,
                'quantity' => 111,
                'created_at' => '2019-05-27 05:54:32',
                'updated_at' => '2019-05-27 05:54:32',
            ),
            2 => 
            array (
                'id' => 3,
                'item_id' => 17,
                'order_id' => 2,
                'quantity' => 5,
                'created_at' => '2019-05-27 05:55:28',
                'updated_at' => '2019-05-27 05:55:28',
            ),
            3 => 
            array (
                'id' => 4,
                'item_id' => 16,
                'order_id' => 3,
                'quantity' => 4,
                'created_at' => '2019-05-27 05:56:05',
                'updated_at' => '2019-05-27 05:56:05',
            ),
        ));
        
        
    }
}