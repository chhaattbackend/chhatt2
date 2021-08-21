<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_assign', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('agent_id')->nullable();
            $table->integer('lead_id')->nullable();
            $table->text('client_feedback')->nullable();
            $table->text('realtor_feedback')->nullable();
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
        Schema::dropIfExists('lead_assign');
    }
}
