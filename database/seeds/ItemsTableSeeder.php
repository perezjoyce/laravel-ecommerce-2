<?php

use Illuminate\Database\Seeder;
use App\Item;
class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::insert([
            ['name' => 'Item 1', 'description' => 'Description 1', 'price' => 10, 'category_id' => 1],
            ['name' => 'Item 2', 'description' => 'Description 2', 'price' => 10, 'category_id' => 1],
            ['name' => 'Item 3', 'description' => 'Description 3', 'price' => 10, 'category_id' => 2],
            ['name' => 'Item 4', 'description' => 'Description 4', 'price' => 10, 'category_id' => 2],
            ['name' => 'Item 5', 'description' => 'Description 5', 'price' => 10, 'category_id' => 3],
            ['name' => 'Item 6', 'description' => 'Description 6', 'price' => 10, 'category_id' => 3],
            ['name' => 'Item 7', 'description' => 'Description 7', 'price' => 10, 'category_id' => 4],
            ['name' => 'Item 8', 'description' => 'Description 8', 'price' => 10, 'category_id' => 4],
            ['name' => 'Item 9', 'description' => 'Description 9', 'price' => 10, 'category_id' => 1]
        ]);
    }
}