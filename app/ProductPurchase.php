<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    protected $table="amar_product_purchase";
    protected $primaryKey="product_purchase_id";
    public $timestamps=false;
}
