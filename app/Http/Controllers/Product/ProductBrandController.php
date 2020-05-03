<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductBrand;

class ProductBrandController extends Controller
{
    public function prductBrandIndex(Request $request)
    {
        return view('Product.brand');
    }
    public function getAllbrand(Request $request)
    {
        $data=ProductBrand::where('product_brand_user_id',$request->session()->get('loggedUser'))
                            ->where('product_brand_id_is_deleted',0)
                            ->get();

        return response()->json(array('data'=>$data));

    }
    public function insertBrand(Request $request)
    {
        $data=new ProductBrand();
        $data->product_brand_user_id=$request->session()->get('loggedUser');
        $data->product_brand_name=$request->brandname;
        $data->product_brand_id_is_deleted=0;
        $data->save();

    }
    public function updateData(Request $request)
    {
        $id=$request->id;
        $data=ProductBrand::where('product_brand_id',$id)
                            ->where('product_brand_user_id',$request->session()->get('loggedUser'))
                            ->where('product_brand_id_is_deleted',0)
                            ->first();

        return response()->json(array('data'=>$data));
    }
    public function updateDataStore(Request $request)
    {
        $data=ProductBrand::where('product_brand_id',$request->id)
                            ->where('product_brand_user_id',$request->session()->get('loggedUser'))
                            ->update([

                                'product_brand_name'=>$request->name,
                            ]);
    }
    public function deleteData(Request $request)
    {
        $data=ProductBrand::where('product_brand_id',$request->id)
                            ->where('product_brand_user_id',$request->session()->get('loggedUser'))
                            ->update([

                                'product_brand_id_is_deleted'=>1,
                            ]);
    }
}
