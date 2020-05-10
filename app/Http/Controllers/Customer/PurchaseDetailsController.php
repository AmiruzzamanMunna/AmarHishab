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
            AND product_purchase_is_deleted = 0
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
    public function updatePurchasingDetails(Request $request)
    {
        $product_id=$request->product_id;
        $customer_id=$request->customer_id;
        $quantity=$request->quantity;
        $amount=$request->amount;

        $purchase_id=$request->purchase_id;
        $update_product_id=$request->update_product_id;
        $updateQuantity=$request->updateQuantity;
        $newQuantity=$request->newQuantity;
        $updatePrice=$request->updatePrice;

        $getDate=$request->getDate;

        if($update_product_id){

            foreach($update_product_id as $key=>$val){

                $productData=ProductDetails::where('product_details_id',$update_product_id[$key])
                                ->where('product_details_user_id',$request->session()->get('loggedUser'))
                                ->where('product_details_is_deleted',0)
                                ->first();

                $data= ProductPurchase::where('product_purchase_id',$purchase_id[$key])
                                        ->where('product_purchase_date',$getDate)
                                        ->where('product_purchase_customer_id',$customer_id)
                                        ->first();

                $data->product_purchase_customer_id=$customer_id;
                $data->product_purchase_product_id=$update_product_id[$key];
                if($newQuantity[$key]){

                    $data->product_purchase_quantity=$newQuantity[$key];
                    $productData->product_details_quantity=$productData->product_details_quantity+$updateQuantity[$key]-$newQuantity[$key];
                    $productData->save(); 

                }
                
                $data->product_purchase_amount=$updatePrice[$key];
                $data->product_purchase_date=$getDate;
                $data->product_purchase_is_deleted=0;
                $data->save();
                     

            }
        }

        if($product_id){

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
                $data->product_purchase_date=$getDate;
                $data->product_purchase_is_deleted=0;
                $data->save();
                $productData->product_details_quantity=$productData->product_details_quantity-$quantity[$key];
                $productData->save();
            }


        }

        

        
    }
    public function purchasingRemovingDetails(Request $request)
    {

        $userid=$request->session()->get('loggedUser');
        $date=$request->date;
        $data=ProductPurchase::where('product_purchase_user_id',$userid)
                            ->where('product_purchase_customer_id',$request->id)
                            ->where('product_purchase_date',$date)
                            ->where('product_purchase_product_id',$request->product_id)
                            ->where('product_purchase_id',$request->purchase_id)
                            ->where('product_purchase_is_deleted',0)
                            ->update([
                                'product_purchase_is_deleted'=>1
                            ]);
    }
}
