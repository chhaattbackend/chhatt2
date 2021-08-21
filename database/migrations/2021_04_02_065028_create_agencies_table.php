<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('status')->nullable();
            $table->integer('verified')->nullable();
            $table->string('major_area', 50)->nullable();
            $table->string('minor_area', 50)->nullable();
            $table->text('location')->nullable();
            $table->integer('area_one_id')->nullable();
            $table->integer('area_two_id')->nullable();
            $table->integer('area_three_id')->nullable();
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
        Schema::dropIfExists('agencies');
    }
}
