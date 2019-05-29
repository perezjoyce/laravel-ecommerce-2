<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('items')->delete();
        
        \DB::table('items')->insert(array (
            0 => 
            array (
                'id' => 10,
                'name' => 'Item 1',
                'description' => 'Description 1',
                'price' => '10.00',
                'image_path' => 'images/1558690744.jpg',
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2019-05-24 09:39:04',
            ),
            1 => 
            array (
                'id' => 11,
                'name' => 'Item 2',
                'description' => 'Description 2',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 12,
                'name' => 'Item 3',
                'description' => 'Description 3',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 13,
                'name' => 'Item 4',
                'description' => 'Description 4',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 14,
                'name' => 'Item 5',
                'description' => 'Description 5',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 15,
                'name' => 'Item 6',
                'description' => 'Description 6',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 16,
                'name' => 'Item 7',
                'description' => 'Description 7',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 17,
                'name' => 'Item 8',
                'description' => 'Description 8',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 18,
                'name' => 'Item 9',
                'description' => 'Description 9',
                'price' => '10.00',
                'image_path' => 'https://www.setrokate.com/images/default-.jpg',
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}