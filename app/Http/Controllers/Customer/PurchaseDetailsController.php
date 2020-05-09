<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductPurchase;
use App\ProductDetails;
use DB;

class PurchaseDetailsController extends Controller
{
    public function customerPurchaseDetails(Request $request)
    {
        return view('Customer.purchasedetails');
    }
    public function customerPurchaseGet(Request $request)
    {
        $userid=$request->session()->get('loggedUser');
        $date=$request->date;

        $data=DB::select("

        SELECT 
        customer_details_id,
        customer_details_name,
        customer_details_address,
        customer_details_phn,
        customer_type_name,
        COUNT(product_purchase_customer_id) AS times
    FROM
        amar_customer_details
            LEFT JOIN
        amar_customer_type ON amar_customer_type.customer_type_id = amar_customer_details.customer_details_type
            LEFT JOIN
        amar_product_purchase ON amar_product_purchase.product_purchase_customer_id = amar_customer_details.customer_details_id
    WHERE
        customer_details_is_deleted = 0
            AND product_purchase_user_id = $userid
            AND product_purchase_date = '$date'
    GROUP BY customer_details_id
        ");

        return response()->json(array('data'=>$data));
    }
    public function customerDetailsIdWise(Request $request)
    {
        $userid=$request->session()->get('loggedUser');
        $date=$request->date;
        $id=$request->id;
        $data=ProductPurchase::where('product_purchase_user_id',$userid)
                            ->where('product_purchase_customer_id',$id)
                            ->where('product_purchase_date',$date)
                            ->where('product_purchase_is_deleted',0)
                            ->get();

        $product=DB::select(
                    "SELECT 
                    product_details_id,
                    product_details_name,
                    product_details_purchase_amount,
                    product_details_quantity
                FROM
                    amar_product_details
                        LEFT JOIN
                    amar_product_purchase ON amar_product_purchase.product_purchase_product_id = amar_product_details.product_details_id
                WHERE
                    product_details_user_id = $userid
                GROUP BY product_details_id "
                );
                    

        return response()->json(array('data'=>$data,'product'=>$product));
    }
}
