<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductCategory;

class ProductCategoryController extends Controller
{
    public function categoryIndex(Request $request)
    {
        return view('Product.category');
    }
    public function getAllCategoryData(Request $request)
    {
        $data=ProductCategory::where('product_category_user_id',$request->session()->get('loggedUser'))
                                ->where('product_category_is_deleted',0)
                                ->get();

        return response()->json(array('data'=>$data));
    }
    public function insertCategoryName(Request $request)
    {
        $data=new ProductCategory();
        $data->product_category_name=$request->catname;
        $data->product_category_user_id=$request->session()->get('loggedUser');
        $data->product_category_is_deleted=0;
        $data->save();
    }
    public function updateCategory(Request $request)
    {
        $id=$request->id;

        $data=ProductCategory::where('product_category_id',$id)
                                ->where('product_category_user_id',$request->session()->get('loggedUser'))
                                ->where('product_category_is_deleted',0)
                                ->first();

        return response()->json(array('data'=>$data));

    }
    public function updateCategoryStore(Request $request)
    {
        $data=ProductCategory::where('product_category_id',$request->id)
                                ->where('product_category_user_id',$request->session()->get('loggedUser'))
                                ->where('product_category_is_deleted',0)
                                ->update([
                                    'product_category_name'=>$request->name,
                                ]);
    }
    public function deleteCategory(Request $request)
    {
        $data=ProductCategory::where('product_category_id',$request->id)
                                ->where('product_category_user_id',$request->session()->get('loggedUser'))
                                ->update([
                                    'product_category_is_deleted'=>1,
                                ]);
    }
}
