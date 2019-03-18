<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('featured')->default(0);
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->integer('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('category')->nullable();
            $table->string('rating')->nullable();
            $table->string('reviews_number')->nullable();
            $table->string('marker_color')->nullable();
            $table->string('marker_image')->nullable();
            $table->text('gallery')->nullable();
            $table->text('tags')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->text('opening_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maps');
    }
}
