<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgents1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents1', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('d_id')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('office_id')->nullable();
            $table->string('position')->nullable();
            $table->string('mobile')->nullable();
            $table->string('status')->default('1');
            $table->integer('lead_value')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents1');
    }
}
