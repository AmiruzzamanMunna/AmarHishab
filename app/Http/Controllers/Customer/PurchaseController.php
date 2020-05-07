<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PurchaseController extends Controller
{
    public function getAllProductDetails(Request $request)
    {
        $userid=$request->session()->get('loggedUser');

        $data=DB::select(
            "SELECT 
            product_details_id,
            product_details_name,
            product_details_purchase_amount,
            ((product_details_quantity) - (IFNULL(product_purchase_quantity, 0))) AS availablequantity
        FROM
            amar_product_details
                LEFT JOIN
            amar_product_purchase ON amar_product_purchase.product_purchase_product_id = amar_product_details.product_details_id
        WHERE
            product_details_user_id = $userid
        GROUP BY product_details_id "
        );

        return response()->json(array('data'=>$data));

    }
    public function getAvailableProduct(Request $request)
    {
        $userid=$request->session()->get('loggedUser');

        $data=DB::select(
            "SELECT 
            product_details_id,
            product_details_name,
            product_details_purchase_amount,
            ((product_details_quantity) - (IFNULL(product_purchase_quantity, 0))) AS availablequantity
        FROM
            amar_product_details
                LEFT JOIN
            amar_product_purchase ON amar_product_purchase.product_purchase_product_id = amar_product_details.product_details_id
        WHERE
            product_details_user_id = $userid
             AND product_details_id=$request->id
        limit 1"
        );

        return response()->json(array('data'=>$data));
    }
}
