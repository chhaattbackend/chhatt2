<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSale extends Model
{


    protected $fillable = [
        'project_id',
        'shop_id',
        'buyer_id',
        'price'

    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function shop()
    {

        return $this->belongsTo(ProjectShop::class, 'shop_id');
    }

    public function buyer()
    {

        return $this->belongsTo(ProjectBuyer::class, 'buyer_id');
    }
}
