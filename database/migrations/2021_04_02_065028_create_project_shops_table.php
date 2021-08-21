<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_shops', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('project_id')->nullable();
            $table->string('name', 50)->nullable();
            $table->integer('floor')->nullable();
            $table->integer('size')->nullable();
            $table->string('size_type', 11)->nullable();
            $table->string('code', 11)->nullable();
            $table->string('type', 11)->nullable();
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
        Schema::dropIfExists('project_shops');
    }
}
