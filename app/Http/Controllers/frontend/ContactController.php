<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use App\Mail\contactMail;
use App\Category;
use App\Website_brand;

class ContactController extends Controller
{
    protected $categories, $brands;

    public function __construct() {
        $this->categories = Category::Active()->OrderBy('order')->get();
        $this->brands = Website_brand::Active()->OrderBy('id')->get();
        View::share([
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }

    //show contact us page function
    public function index() {
        return view("frontend.pages.contact");
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