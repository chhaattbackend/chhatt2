<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSalesInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_sales_installments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('project_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('buyer_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('down_payment')->nullable();
            $table->integer('installment_rate')->nullable();
            $table->integer('paid')->nullable();
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
        Schema::dropIfExists('project_sales_installments');
    }
}
