<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductPurchase;
use App\ProductDetails;
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
            product_details_quantity
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
            product_details_quantity AS availablequantity
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
    public function purchasingIndex(Request $request)
    {
        return view("Customer.purchaseIndex");
    }
    public function storePurchasingDetails(Request $request)
    {
        $product_id=$request->product_id;
        $customer_id=$request->customer_id;
        $quantity=$request->quantity;
        $amount=$request->amount;
        $date=$request->date;

        

        foreach($product_id as $key=>$val){

            $productData=ProductDetails::where('product_details_id',$product_id[$key])
                            ->where('product_details_user_id',$request->session()->get('loggedUser'))
                            ->where('product_details_is_deleted',0)
                            ->first();
          
            $data= new ProductPurchase();
            $data->product_purchase_user_id=$request->session()->get('loggedUser');
            $data->product_purchase_customer_id=$customer_id;
            $data->product_purchase_product_id=$product_id[$key];
            $data->product_purchase_quantity=$quantity[$key];
            $data->product_purchase_amount=$amount[$key];
            $data->product_purchase_date=$date;
            $data->product_purchase_is_deleted=0;
            $data->save();
            $productData->product_details_quantity=$productData->product_details_quantity-$quantity[$key];
            $productData->save();
        }
       
    }
    public function getCustomerPurchaseDetails(Request $request)
    {
        $userid=$request->session()->get('loggedUser');
        $date=$request->date;

        $data=DB::select(
            "SELECT 
            product_details_id,
            product_brand_name,
            product_producer_name,
            product_details_name,
            ((product_details_quantity) - (IFNULL(product_purchase_quantity, 0))) AS product_details_quantity,
            product_purchase_date
            
        FROM
            amar_product_details
                LEFT JOIN
            amar_product_purchase ON amar_product_purchase.product_purchase_product_id = amar_product_details.product_details_id
                LEFT JOIN
            amar_product_brand ON amar_product_brand.product_brand_id = amar_product_details.product_details_brand_id
                LEFT JOIN
            amar_product_producer ON amar_product_producer.product_producer_id = amar_product_details.product_details_com_id
                LEFT JOIN
            amar_product_category ON amar_product_category.product_category_id = amar_product_details.product_details_product_cat_id
        WHERE
            product_details_user_id = $userid
                AND product_purchase_date = '$date'
                and product_purchase_is_deleted=0
        GROUP BY product_details_id "
        );


        return response()->json(array('data'=>$data));
    }
}
