<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductDetails;
use App\ProductBrand;
use App\ProductProducerCompany;
use App\ProductCategory;

class ProductDetailsController extends Controller
{
    public function productDetailsIndex(Request $request)
    {
        return view('Product.productdetails');
    }
    public function getAllProductDetails(Request $request)
    {
        $data=ProductDetails::where('product_details_user_id',$request->session()->get('loggedUser'))
                            ->where('product_details_is_deleted',0)
                            ->leftjoin('amar_product_brand','amar_product_brand.product_brand_id','amar_product_details.product_details_brand_id')
                            ->leftjoin('amar_product_producer','amar_product_producer.product_producer_id','amar_product_details.product_details_com_id')
                            ->leftjoin('amar_product_category','amar_product_category.product_category_id','amar_product_details.product_details_product_cat_id')
                            ->get();

        return response()->json(array('data'=>$data));
    }
    public function getListedProduct(Request $request)
    {
        $brands=ProductBrand::where('product_brand_user_id',$request->session()->get('loggedUser'))
                            ->where('product_brand_id_is_deleted',0)
                            ->get();

        $companyName=ProductProducerCompany::where('product_producer_user_id',$request->session()->get('loggedUser'))
                                            ->where('product_producer_is_deleted',0)
                                            ->get();

        $category=ProductCategory::where('product_category_user_id',$request->session()->get('loggedUser'))
                                    ->where('product_category_is_deleted',0)
                                    ->get();

        return response()->json(array('brands'=>$brands,'companyName'=>$companyName,'category'=>$category));
    }
    public function insertProductDetails(Request $request)
    {
        $data=new ProductDetails();
        $data->product_details_user_id=$request->session()->get('loggedUser');
        $data->product_details_brand_id=$request->brands;
        $data->product_details_com_id=$request->company;
        $data->product_details_product_cat_id=$request->category;
        $data->product_details_name=$request->pname;
        $data->product_details_purchase_amount=$request->pamount;
        $data->product_details_quantity=$request->pquantity;
        $data->product_details_entry_date=$request->pdate;
        $data->product_details_is_deleted=0;
        $data->save();
    }
    public function editProductDetails(Request $request)
    {
        $data=ProductDetails::where('product_details_user_id',$request->session()->get('loggedUser'))
                            ->where('product_details_id',$request->id)
                            ->where('product_details_is_deleted',0)
                            ->first();

        $brands=ProductBrand::where('product_brand_user_id',$request->session()->get('loggedUser'))
                            ->where('product_brand_id_is_deleted',0)
                            ->get();

        $companyName=ProductProducerCompany::where('product_producer_user_id',$request->session()->get('loggedUser'))
                            ->where('product_producer_is_deleted',0)
                            ->get();

        $category=ProductCategory::where('product_category_user_id',$request->session()->get('loggedUser'))
                                    ->where('product_category_is_deleted',0)
                                    ->get();

        return response()->json(array('data'=>$data,'brands'=>$brands,'companyName'=>$companyName,'category'=>$category));
    }
    public function editProductDetailsUpdate(Request $request)
    {
        $data=ProductDetails::where('product_details_user_id',$request->session()->get('loggedUser'))
                            ->where('product_details_id',$request->id)
                            ->where('product_details_is_deleted',0)
                            ->update([
                                'product_details_brand_id'=>$request->brands,
                                'product_details_com_id'=>$request->company,
                                'product_details_product_cat_id'=>$request->category,
                                'product_details_name'=>$request->pname,
                                'product_details_purchase_amount'=>$request->pamount,
                                'product_details_quantity'=>$request->pquantity,
                                'product_details_entry_date'=>$request->pdate,
                            ]);
    }
    public function deleteProductDetailsUpdate(Request $request)
    {
        $data=ProductDetails::where('product_details_user_id',$request->session()->get('loggedUser'))
                            ->where('product_details_id',$request->id)
                            ->where('product_details_is_deleted',0)
                            ->update([
                                'product_details_is_deleted'=>1,
                            ]);
    }
}
