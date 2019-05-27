<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::insert([
            ['status_name' => 'Pending', 'created_at' => NULL, 'updated_at' => NULL],
            ['status_name' => 'Completed', 'created_at' => NULL, 'updated_at' => NULL],
            ['status_name' => 'Cancelled', 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }
}
