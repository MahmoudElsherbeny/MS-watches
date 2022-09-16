<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Mail\resetEditorPasswordMail;
use App\Admin;

class ForgotPasswordController extends Controller
{
    //forgot password function - to show admin forgot password form page
    public function forgotPasswordForm() {
        if(Auth::guard('admin')->check()) {
            return Redirect::back();
        }
        else {
            return view('AdminAuth.passwords.email');
        }
    }

    //function send link - to send reset password link for admins users
    public function sendResetLink(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $editor = Admin::Where('email',$request->input('email'))->first();
        try {
            //check if the user exist or not
            if($editor) {
                $editor->hash = Str::random(60);
                $editor->save();

                Mail::to($editor->email)->send(new resetEditorPasswordMail($editor));
                Session::flash('success','Reset password email sent successfuly');
            }
            else {
                Session::flash('error','This email doesn\'t exist !');
            }
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }
        
        return Redirect::back();
    }

}
