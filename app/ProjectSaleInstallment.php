<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSaleInstallment extends Model
{
    protected $guarded = [];
    protected $table='project_sales_installments';

    public function shop(){

        return $this->belongsTo(ProjectShop::class,'shop_id');
    }

    public function buyer(){

        return $this->belongsTo(ProjectBuyer::class,'buyer_id');
    }
}
