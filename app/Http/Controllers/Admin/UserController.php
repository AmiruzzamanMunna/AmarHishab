<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\AmarUser;

class UserController extends Controller
{
    public function userList(Request $request)
    {

        return view('Admin.userlist');
                
    }

    public function getAllUser(Request $request)
    {
        $data=AmarUser::where('amar_user_is_deleted',0)
                        ->get();


        foreach($data as $eachdata){

            $dataVal[]=[

                'amar_user_id'=>$eachdata->amar_user_id,
                'name'=>$eachdata->name,
                'username'=>$eachdata->username,
                'password'=>$eachdata->password,
                'address'=>$eachdata->address,
                'phnnumber'=>$eachdata->phnnumber,
            ];
        }
        
        
        return response()->json(array('data'=>$dataVal));
    }

    public function addUser(Request $request)
    {

        $data= new AmarUser();
        $data->name=$request->name;
        $data->username=$request->username;
        $data->password= Hash::make($request->pass);
        $data->address=$request->address;
        $data->phnnumber=$request->phnnum;
        $data->amar_user_is_deleted=0;
        $data->save();

        return response()->json(array('status'=>'success'));
    }

    public function editUser(Request $request)
    {
        $id=$request->id;
        
        $data=AmarUser::where('amar_user_id',$id)
                        ->where('amar_user_is_deleted',0)
                        ->first();


        return response()->json(array('data'=>$data));
    }
    public function updateUser(Request $request)
    {

        $updateid=$request->updateid;
        
        AmarUser::where('amar_user_id',$updateid)
                ->update([

                    'name'=>$request->updatename,
                    'password'=>($request->updatepass)?Hash::make($request->updatepass):$request->existpass,
                    'address'=>$request->updateaddress,
                    'phnnumber'=>$request->updatephnnum,
                ]);

        return response()->json(array('status'=>'success'));
    }
    public function deleteUser(Request $request)
    {
        $id=$request->id;
        
        $data=AmarUser::where('amar_user_id',$id)
                        ->update(['amar_user_is_deleted'=>1]);

        return response()->json(array('status'=>'success'));
    }
}
