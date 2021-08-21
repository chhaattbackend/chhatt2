<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeads11Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads11', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50)->nullable();
            $table->integer('phone')->nullable();
            $table->string('email', 50)->nullable();
            $table->text('description')->nullable();
            $table->integer('budget')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('how_soon', 50)->nullable();
            $table->text('family')->nullable();
            $table->string('leadsource', 50)->nullable();
            $table->integer('status')->nullable();
            $table->integer('lead_status')->nullable();
            $table->integer('call_status')->nullable();
            $table->integer('chat_status')->nullable();
            $table->integer('response_status')->nullable();
            $table->string('property_type', 50)->nullable();
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
        Schema::dropIfExists('leads11');
    }
}
