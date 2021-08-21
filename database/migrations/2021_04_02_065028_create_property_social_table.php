<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertySocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_social', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('property_id')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('views')->nullable();
            $table->integer('clicks')->nullable();
            $table->integer('impressions')->nullable();
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
        Schema::dropIfExists('property_social');
    }
}
