<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductProducerCompany;


class ProductProducerCompanyController extends Controller
{
    public function producerIndex(Request $request)
    {
        return view('Product.producer');
    }
    public function getAllProductCompany(Request $request)
    {
        $data=ProductProducerCompany::where('product_producer_user_id',$request->session()->get('loggedUser'))
                                    ->where('product_producer_is_deleted',0)
                                    ->get();

        return response()->json(array('data'=>$data));
    }
    public function insertCompanyName(Request $request)
    {
        $data=new ProductProducerCompany();
        $data->product_producer_name=$request->comname;
        $data->product_producer_user_id=$request->session()->get('loggedUser');
        $data->product_producer_is_deleted=0;
        $data->save();
    }
    public function updateProducerName(Request $request)
    {
        $id=$request->id;

        $data=ProductProducerCompany::where('product_producer_id',$id)
                                    ->where('product_producer_user_id',$request->session()->get('loggedUser'))
                                    ->where('product_producer_is_deleted',0)
                                    ->first();

        return response()->json(array('data'=>$data));

    }
    public function updateProducerNameStore(Request $request)
    {
        $data=ProductProducerCompany::where('product_producer_id',$request->id)
                                    ->where('product_producer_user_id',$request->session()->get('loggedUser'))
                                    ->where('product_producer_is_deleted',0)
                                    ->update([
                                        'product_producer_name'=>$request->name,
                                    ]);
    }
    public function deleteProducerName(Request $request)
    {
        $data=ProductProducerCompany::where('product_producer_id',$request->id)
                                    ->where('product_producer_user_id',$request->session()->get('loggedUser'))
                                    ->update([
                                        'product_producer_is_deleted'=>1,
                                    ]);
    }
}
