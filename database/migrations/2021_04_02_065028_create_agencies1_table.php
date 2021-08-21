<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencies1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies1', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('thumbnail')->nullable();
            $table->tinyInteger('verified')->default(0);
            $table->string('name');
            $table->string('o_name')->nullable();
            $table->text('o_contact')->nullable();
            $table->text('des')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable()->default('Karachi');
            $table->string('major_area')->nullable()->default('DHA');
            $table->text('minor_area')->nullable();
            $table->string('location')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('agencies1');
    }
}
