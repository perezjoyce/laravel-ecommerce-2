<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image_path')->default('https://www.setrokate.com/images/default-.jpg');
            $table->unsignedInteger('category_id');
            $table->nullableTimestamps();

             //relate categories table with items
             $table->foreign('category_id')
             ->references('id')
             ->on('categories')
             ->onDelete('restrict')
             ->onUpdate("cascade"); 
             //if primary key is updated, will reflect to its children
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
