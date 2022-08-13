<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Category;
use App\Order;
use App\State;
use App\Traits\ImageFunctions;
use App\User;
use App\User_info;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use ImageFunctions;
    protected $categories;

    public function __construct() {
        $this->categories = Category::Where('status','active')->OrderBy('order')->get();
        View::share('categories', $this->categories);
    }

    //function edit - show user edit profile page
    public function index($id,$name)
    {
        $user = User::findOrFail($id);
        if(Auth::user()->id == $id) {
            return view('frontend.profile.profile')->with(['user' => $user]);
        }
        else {
            return Redirect::back();
        }
    }

    //function edit - show user edit profile page
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $states = State::all();
        if(Auth::user()->id == $id) {
            return view('frontend.profile.update')->with(['user' => $user, 'states' => $states]);
        }
        else {
            return Redirect::back();
        }
    }

    //update function - update user profile
    public function update(Request $request,$id) {
        $validatedData = $request->validate([
            'cover' => 'nullable|max:10000|mimes:jpeg,bmp,png,jpg',
            'image' => 'nullable|max:8000|mimes:jpeg,bmp,png,jpg',
            'name' => 'required|max:30|min:3|regex:/^[a-zA-Z0-9 ]+$/',
            'phone' => 'required|min:11|numeric',
            'city' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'address' => 'required'
        ]);

        try {
            $user = User::find($id);
            if($user) {
                $user->name = $request->input('name');
                //check if user info exist in table or not
                if($user->user_info) {
                    $user->user_info->phone = $request->input('phone');
                    $user->user_info->state_id = $request->input('state');
                    $user->user_info->city = $request->input('city');
                    $user->user_info->address = $request->input('address');
                }
                else {
                    User_info::create([
                        'user_id' => $id,
                        'phone' => $request->input('phone'),
                        'state_id' => $request->input('state'),
                        'city' => $request->input('city'),
                        'address' => $request->input('address'),
                    ]);
                }

                //set cover if entered
                if($request->hasFile('cover')) {
                    if($user->user_info->cover) {
                        $this->delete_if_exist($user->user_info->cover);
                    }
                    $user->user_info->cover = $this->store_image_path($request->cover, 'users');
                }
                //set image if entered
                if($request->hasFile('image')) {
                    if($user->user_info->image) {
                        $this->delete_if_exist($user->user_info->image);
                    }
                    $user->user_info->image = $this->store_image_path($request->image, 'users');;
                }

                //check if there changes to update
                if($user->isDirty() || $user->user_info->isDirty()) {
                    $user->save();
                    $user->user_info->save();
                    Session::flash('success','Your profile updated succefully');
                }
                else {
                    Session::flash('error','No changes to update');
                }
            }
            return Redirect::back();

        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }
    }

    //function ShowChangePasswordForm - show user profile change passwords page
    public function ShowChangePasswordForm($id)
    {
        $user = User::findOrFail($id);
        if(Auth::user()->id == $id) {
            return view('frontend.profile.change_password')->with(['user' => $user]);
        }
        else {
            return Redirect::back();
        }
    }

    //change password function - update user profile
    public function ChangePassword(Request $request,$id,$name) {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        try {
            $user = User::find($id);
            if($user) {
                if (Hash::check($request->input('current_password'), $user->password)) {
                    $user->password = Hash::make($request->input('new_password'));

                    //check if there changes to update
                    if($user->isDirty()) {
                        $user->save();
                        Session::flash('success','Your password updated succefully');
                    }
                    else {
                        Session::flash('error','No changes to update');
                    }
                }
                else {
                    Session::flash('error','Your password isn\'t correct');
                }
            }
            return Redirect::back();

        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }
    }

    //function orders - show user orders page
    public function orders($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::Where('user_id',$user->id)->orderBy('created_at','Desc')->get();
        if($user) {
            return view('frontend.profile.orders')->with(['user' => $user, 'orders' => $orders]);
        }
        else {
            return Redirect::back();
        }
    }

}
