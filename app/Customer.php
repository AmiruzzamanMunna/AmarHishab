<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table="amar_customer_details";
    protected $primaryKey="customer_details_id";
    public $timestamps=false;
}
