<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('firebase_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->integer('role_id')->nullable();
            $table->integer('status')->nullable();
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->text('address')->nullable();
            $table->text('office_address')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('image')->nullable();
            $table->text('dp')->nullable();
            $table->integer('isonline')->nullable();
            $table->integer('locked')->default(0);
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
        Schema::dropIfExists('users');
    }
}
