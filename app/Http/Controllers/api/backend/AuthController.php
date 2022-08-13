<?php

namespace App\Http\Controllers\api\backend;

use App\Http\Controllers\Controller;
use App\Traits\ApiGeneralTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Admin;
use Exception;

class AuthController extends Controller
{
    use ApiGeneralTrait;

    //login admin to api
    public function login(Request $request) {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        try {
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return $this->returnErrorMsg(3000, $validator->errors());
            }
            else {  

                $admin = Admin::Where('email',$request->input('email'))->first();
                    //check if user exist
                    if($admin) {
                        //check if his account active
                        if($admin->status == 'active') {
                            $token = Auth::guard('admin-api')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
                            if ($token)
                            {
                                $admin = Auth::guard('admin-api')->user();
                                $admin->token = $token;

                                return $this->returnData('admin', $admin, 'admin login');
                            }else{
                                return $this->returnErrorMsg(3003, 'email or password is wrong');
                            }
                        }
                        else {
                            return $this->returnErrorMsg(3003, 'sorry you can\'t access your acount for now');
                        }
                    }
                    else{
                        return $this->returnErrorMsg(3003, 'email not found');
                    }
             } 
        } catch (Exception $e) {
            return $this->returnErrorMsg(003, $e);
        }
    }

    public function logout(Request $request) {
        $token = $request->header('auth_token');
        if($token) {
            try {
                Auth::guard('admin-api')->logout();
                //JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMsg('admin logout success');
            } catch(Exception $e) {
                return $this->returnErrorMsg(001, 'error: '.$e);
            }
        }
        else {
            return $this->returnErrorMsg(001, 'something is wrong');
        }
    }
}
