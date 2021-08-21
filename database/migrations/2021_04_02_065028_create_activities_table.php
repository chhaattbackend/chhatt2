<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->bigInteger('p_id');
            $table->string('u_id');
            $table->bigInteger('likes')->nullable()->default(0);
            $table->bigInteger('views')->default(0);
            $table->bigInteger('eng')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('thumbnail', 5000)->nullable();
            $table->text('p_name')->nullable();
            $table->text('office_name')->nullable();
            $table->text('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
