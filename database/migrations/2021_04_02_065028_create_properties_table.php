<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->integer('area_one_id')->nullable();
            $table->integer('area_two_id')->nullable();
            $table->integer('area_three_id')->nullable();
            $table->text('category')->nullable();
            $table->text('name')->nullable();
            $table->text('address')->nullable();
            $table->integer('price')->nullable();
            $table->integer('size')->nullable();
            $table->string('size_type', 20)->nullable();
            $table->text('type')->nullable();
            $table->text('bed')->nullable();
            $table->text('bath')->nullable();
            $table->text('image')->nullable();
            $table->text('images')->nullable();
            $table->text('description')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('advertised')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
