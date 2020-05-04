<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table="amar_product_category";
    protected $primaryKey="product_category_id";
    public $timestamps=false;
}
