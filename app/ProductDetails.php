<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table="amar_product_details";
    protected $primaryKey="product_details_id";
    public $timestamps=false;
}
