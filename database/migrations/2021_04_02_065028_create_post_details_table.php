<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country')->default('Pakistan');
            $table->string('region')->default('South');
            $table->string('state')->default('4');
            $table->text('city')->nullable();
            $table->text('latlng');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('major_area')->nullable()->default('DHA');
            $table->string('minor_area')->nullable();
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
        Schema::dropIfExists('post_details');
    }
}
