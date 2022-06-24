<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Admin;

class LoginController extends Controller
{
    //login function - to show admin login form page
    public function LoginForm() {
        if(Auth::guard('admin')->check()) {
            return Redirect::back();
        }
        else {
            return view('AdminAuth.login');
        }
    }

     //function login - to login user
     public function login(Request $request)
     {
         $validatedData = $request->validate([
             'email' => 'required',
             'password' => 'required',
         ]);
 
         $editor = Admin::Where('email',$request->input('email'))->first();
         $remember = ($request->input('remember_me')) ? true : false;
         try {
            //check if user exist
            if($editor) {
                //check if his account active
                if($editor->status == 'active') {
                    if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')],$remember))
                    {
                        return Redirect::route('dashboard');
                    }else{
                        Session::flash('error','email or password is wrong');
                    }
                }
                else {
                    Session::flash('error','sorry you can\'t access your acount for now');
                }
            }
            else{
                Session::flash('error','account doesn\'t exist');
            }
         } catch (EXTENSION $e) {
             Session::flash('error','Error:'.$e);
         }
         
         return Redirect::back();
 
     }

     //function logout - to logout user session
     public function logout() {
        Auth::guard('admin')->logout();
        return Redirect::route('AdminAuth.LoginForm');
    }

}
