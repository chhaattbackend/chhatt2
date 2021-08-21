<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->text('u_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('thumbnail')->nullable();
            $table->string('office_id')->nullable();
            $table->string('p_id')->nullable();
            $table->string('d_id')->nullable();
            $table->bigInteger('isonline')->nullable();
            $table->string('status')->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->text('w_id')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('rew')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
