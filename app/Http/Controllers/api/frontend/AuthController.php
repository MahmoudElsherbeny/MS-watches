<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\Controller;
use App\Traits\ApiGeneralTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Exception;

class AuthController extends Controller
{
    use ApiGeneralTrait;

    //login user to api
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

                $user = User::Where('email',$request->input('email'))->first();
                    //check if user exist
                    if($user) {
                        $token = Auth::guard('user-api')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
                        if ($token)
                        {
                            $user = Auth::guard('user-api')->user();
                            $user->token = $token;

                            return $this->returnData('user', $user, 'user login');
                        }else{
                            return $this->returnErrorMsg(3003, 'email or password is wrong');
                        }
                    }
                    else{
                        return $this->returnErrorMsg(3003, 'email not found');
                    }
             } 
        } catch (Exception $e) {
            return $this->returnErrorMsg(001, 'Error: '.$e);
        }
    }

    public function logout(Request $request) {
        $token = $request->header('auth_token');
        if($token) {
            try {
                Auth::guard('user-api')->logout();
                //JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMsg('user logout success');
            } catch(Exception $e) {
                return $this->returnErrorMsg(001, 'Error: '.$e);
            }
        }
        else {
            return $this->returnErrorMsg(001, 'something is wrong');
        }
    }
}
