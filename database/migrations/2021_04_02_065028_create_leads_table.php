<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('area_one_id')->nullable();
            $table->integer('area_two_id')->nullable();
            $table->integer('area_three_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->string('area', 500)->nullable();
            $table->integer('budget')->nullable();
            $table->string('lead_type')->nullable();
            $table->string('how_soon')->nullable();
            $table->string('family_members')->nullable();
            $table->string('property_type')->nullable();
            $table->string('leadsource')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->text('call_status')->nullable();
            $table->text('response_status')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
