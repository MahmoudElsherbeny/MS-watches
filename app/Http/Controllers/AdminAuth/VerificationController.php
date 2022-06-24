<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\newEditorMail;
use App\Admin;

class VerificationController extends Controller
{

    //register function - to show admin register form page
    public function verify_page() {
        $user = Auth::guard('admin')->user();
        if($user->email_verified_at){
            return Redirect::back();
        }
        else {
            return view('AdminAuth.verify_page');
        }
    }

    //function verify - to verify new editor after register
    public function verify($id,$token)
    {

        try {
            //check if the user already exist or not
            $editor = Admin::Where(['id' => $id, 'hash' => $token])->first();
            //check if user verify or not
            if($editor && $editor->email_verified_at == null) {
                //check if verify link isexpired or not
                if($editor->updated_at->diffInHours(now()) > 24) {
                    $msg = 'click on resend verify email to reverify .';
                    $link = 'resend verify email';
                    $route = 'AdminAuth.resend';
                    Session::flash('error','Your verification link expired !');
                    return view('AdminAuth.verify_success')->with(['msg'=>$msg, 'link'=>$link, 'route'=>$route]);
                }
                else {
                    $editor->email_verified_at = now();
                    $editor->hash = Str::random(60);
                    $editor->save();

                    $msg = 'Now you can start your job, enjoy with us .';
                    $link = 'home';
                    $route = 'dashboard';
                    Session::flash('success','Your account verified successfully !');
                    return view('AdminAuth.verify_success')->with(['msg'=>$msg, 'link'=>$link, 'route'=>$route]);
                }
            }
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }
        
        return Redirect::route('dashboard');
    }

    //function resend - resend verify email if editor not verified yet
    public function resend()
    {

        try {
            //check if the user already exist or not
            $login_editor = Auth::guard('admin')->user();
            $editor = Admin::Where('id', $login_editor->id)->first();
            if($editor && $editor->email_verified_at == null) {
                $editor->hash = Str::random(60);
                $editor->save();

                Mail::to($editor->email)->send(new newEditorMail($editor,0));

                $msg = 'Please check your email to verify, enjoy with us .';
                $link = 'home';
                $route = 'dashboard';
                Session::flash('success','verify email sent successfully !');
                return view('AdminAuth.verify_success')->with(['msg'=>$msg, 'link'=>$link, 'route'=>$route]);
            }
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }
        
        return Redirect::route('dashboard');
    }

}