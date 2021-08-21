<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_buyers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('project_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('contact')->nullable();
            $table->text('address')->nullable();
            $table->integer('cnic')->nullable();
            $table->dateTime('dob')->nullable();
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
        Schema::dropIfExists('project_buyers');
    }
}
