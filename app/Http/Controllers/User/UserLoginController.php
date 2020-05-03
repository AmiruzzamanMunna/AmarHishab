<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\AmarUser;

class UserLoginController extends Controller
{
    public function userLoginPage(Request $request)
    {
        return view('User.login');
    }
    public function userLoginCheck(Request $request)
    {
        $username=$request->username;
        $password=$request->password;

        $data=AmarUser::where('username',$username)
                        ->where('amar_user_is_deleted',0)
                        ->first();

        if($data->username && Hash::check($password, $data->password)){

            $request->session()->put('loggedUser',$data->amar_user_id);

            return response()->json(array('status'=>'true'));

        }else{

            return response()->json(array('status'=>'error'));

        }
        
    }
    public function userLogout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('user.userLoginPage');
    }
}
