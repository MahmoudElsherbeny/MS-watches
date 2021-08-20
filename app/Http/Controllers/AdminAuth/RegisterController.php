<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Redirect;
use App\Admin;

class RegisterController extends Controller
{
    protected $redirectTo = '/dashboard/login';

    //register function - to show admin register form page
    public function RegisterForm() {
        return view('AdminAuth.register');
    }

    //function register - to create new user
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:40|min:3|regex:/^[a-zA-Z0-9 ]+$/',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        try {
            //check if the user already exist or not
            if(Admin::Where('email',$request->input('email'))->count() == 0) {
                $admin = new Admin;
                $admin->name = $request->input('name');
                $admin->email = $request->input('email');
                $admin->password = $request->input('password');
                $admin->role = 'editor';
                $admin->status = 'not active';
                $admin->save();

                /*
                //sending email notification after adding new company
                $company_to_send = Company::Where('email',$request->input('email'))->first();
                $user = User::first();
                Notification::send($user, new NewCompanyNotification($company_to_send));
                */

            }
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }
        
        return Redirect::to($redirectTo);

    }

}
