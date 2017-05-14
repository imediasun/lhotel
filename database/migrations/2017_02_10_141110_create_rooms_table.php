<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);
            $table->integer('category')->default(0);
            $table->integer('number')->default(0);
            $table->text('description');
            $table->text('description2');
            $table->string('name')->default(0);
            $table->string('slogan');
            $table->string('image_small')->default(0);
            $table->string('image_medium')->default(0);
            $table->string('image_large')->default(0);
            $table->string('thumbnail')->default(0);
            $table->integer('star')->default(0);
            $table->string('shower')->default('off');
            $table->string('wc')->default('off');
            $table->string('tv')->default('off');
            $table->string('ac')->default('off');
            $table->string('cold')->default('off');
            $table->string('mikrowave')->default('off');
            $table->string('teapot')->default('off');
            $table->bigInteger('price')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
        Schema::dropIfExists('rooms');
    }
}
