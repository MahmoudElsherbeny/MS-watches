<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Traits\CartOptions;
use App\Traits\WishlistOptions;
use App\Category;
use App\User;
use App\Website_brand;

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

    public $categories, $brands;    


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
        $this->brands = Website_brand::Active()->OrderBy('id')->get();
        View::share([
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }

    //show login-register page function
    public function showLoginForm() {
        return view("auth.login");
    }

}
