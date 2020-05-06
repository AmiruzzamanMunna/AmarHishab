<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function customerDetails(Request $request)
    {
        return view('Customer.customer');
    }
    public function getAllCustomer(Request $request)
    {
        $data=Customer::where('customer_user_id',$request->session()->get('loggedUser'))
                        ->where('customer_details_is_deleted',0)
                        ->leftjoin('amar_customer_type','amar_customer_type.customer_type_id','amar_customer_details.customer_details_type')
                        ->get();

        return response()->json(array('data'=>$data));
    }
    public function insertCustomerDetails(Request $request)
    {
        $data= new Customer();
        $data->customer_user_id=$request->session()->get('loggedUser');
        $data->customer_details_type=$request->type;
        $data->customer_details_name=$request->name;
        $data->customer_details_address=$request->address;
        $data->customer_details_phn=$request->phn;
        $data->customer_details_is_deleted=0;
        $data->save();
    }
    public function editCustomerDetails(Request $request)
    {
        $data=Customer::where('customer_user_id',$request->session()->get('loggedUser'))
                        ->where('customer_details_id',$request->id)
                        ->where('customer_details_is_deleted',0)
                        ->first();

        return response()->json(array('data'=>$data));
    }
    public function editCustomerDetailsUpdate(Request $request)
    {
        $data=Customer::where('customer_user_id',$request->session()->get('loggedUser'))
                        ->where('customer_details_id',$request->id)
                        ->where('customer_details_is_deleted',0)
                        ->update([
                            'customer_details_type'=>$request->type,
                            'customer_details_name'=>$request->name,
                            'customer_details_address'=>$request->address,
                            'customer_details_phn'=>$request->phn,
                        ]);
    }
    public function deleteCustomerDetailsUpdate(Request $request)
    {
        $data=Customer::where('customer_user_id',$request->session()->get('loggedUser'))
                        ->where('customer_details_id',$request->id)
                        ->where('customer_details_is_deleted',0)
                        ->update([
                            'customer_details_is_deleted'=>1,
                        ]);
    }
}
