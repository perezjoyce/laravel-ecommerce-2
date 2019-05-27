<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Category 1', 'created_at' => NULL, 'updated_at' => NULL],
            ['name' => 'Category 2', 'created_at' => NULL, 'updated_at' => NULL],
            ['name' => 'Category 3', 'created_at' => NULL, 'updated_at' => NULL],
            ['name' => 'Category 4', 'created_at' => NULL, 'updated_at' => NULL],
        ]);
    }
}
