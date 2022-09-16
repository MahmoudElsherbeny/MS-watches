<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\CartOptions;
use App\Traits\WishlistOptions;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, CartOptions, WishlistOptions;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';

    public $categories;    


    protected function authenticated(Request $request, User $user) {
        // put your thing in here
        $this->RemoveCartFromSessionToDatabase();
        $this->RemoveWishlistFromSessionToDatabase();

        return redirect()->intended($this->redirectPath());
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->redirectTo = redirect()->intended();

        $this->categories = Category::Where('status','active')->OrderBy('order')->get();
        View::share('categories', $this->categories);
    }

    //show login-register page function
    public function showLoginForm() {
        return view("auth.login");
    }

}
