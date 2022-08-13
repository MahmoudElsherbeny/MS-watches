<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Admin;

class ResetPasswordController extends Controller
{
    //reset password function - to show admin reset password form page
    public function resetPasswordForm($token,$email) {
        $editor = Admin::Where(['hash' => $token, 'email' => $email])->first();
        if(Auth::guard('admin')->check() || $editor->updated_at->diffInMinutes(now()) > 60) {//check if link isexpired or not
            return Redirect::route('AdminAuth.LoginForm');
        }
        else {
            return view('AdminAuth.passwords.reset')->with(['editor' => $editor]);
        }
    }

    //reset password function - to reset password for admin user
    public function resetPassword(Request $request,$token,$email)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $editor = Admin::Where(['hash' => $token, 'email' => $email])->first();
        try {
           //check if user exist
           if($editor && $editor->status == 'active') {
                $editor->password = Hash::make($request->input('password'));
                $editor->hash = Str::random(60);
                $editor->save();

                return Redirect::route('AdminAuth.LoginForm');
           }
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }
        
        return Redirect::back();

    }

}
