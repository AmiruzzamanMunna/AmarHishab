<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table="amar_product_brand";
    protected $primaryKey="product_brand_id";
    public $timestamps=false;
}
