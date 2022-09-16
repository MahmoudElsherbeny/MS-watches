<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Admin;
use App\Traits\ImageFunctions;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use ImageFunctions;

    //function index - show user profile page
    public function index($id)
    {
        $editor = Admin::findOrFail($id);
        $open_orders = $editor->orders->where('status', '!=', 'completed')->where('status', '!=', 'cancel');
        $completed_orders = $editor->orders->whereIn('status', ['completed', 'cancel'])->sortByDesc('created_at');

        return view('backend.profile.profile')->with([
            'editor' => $editor,
            'open_orders' => $open_orders,
            'completed_orders' => $completed_orders
        ]);
    }

    //function edit - show user edit profile page
    public function edit($id)
    {
        $user = Admin::findOrFail($id);
        return view('backend.profile.update')->with('user',$user);
    }

    //update function - update user profile
    public function update(Request $request,$id,$name) {
        $validatedData = $request->validate([
            'image' => 'nullable|max:8000|mimes:jpeg,bmp,png,jpg',
            'name' => 'required|max:30|min:3|regex:/^[a-zA-Z0-9 ]+$/',
            'password' => 'sometimes|nullable|min:6',
            'confirm_password' => 'same:password'
        ]);

        try {
            $user = Admin::find($id);
            if($user) {
                $user->name = $request->input('name');
                //set password if entered
                if($request->input('password')) {
                    $user->password = Hash::make($request->input('password'));
                }
                //set images if entered
                if($request->hasFile('image')) {
                    if($user->image) {
                        $this->delete_if_exist($user->image);
                    }
                    $user->image = $this->store_image_path($request->image, 'admins');
                }

                //check if there changes to update
                if($user->isDirty()) {
                    $user->save();
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

}
