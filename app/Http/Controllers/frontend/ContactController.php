<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Mail\contactMail;
use App\Category;

class ContactController extends Controller
{
    //show contact us page function
    public function index() {
        $categories = Category::Where('status','active')->OrderBy('order')->get();
        return view("frontend.pages.contact")->with('categories',$categories);
    }

    public function send(Request $request) { 

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        Mail::to('ms_watches@gmail.com')->send(new contactMail($name,$email,$subject,$message));

        Session::flash('success','category created successfully');
        
        return Redirect::back();

    }

}