<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

use App\Notifications\SlideNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Slide;
use Exception;

class SliderController extends Controller
{
    use ImageFunctions;

    //function index - show Slides page
    public function index()
    {
        $slides = Slide::orderBY('order')->get();
        return view('backend.slider.list')->with('slides',$slides);
    }

    //function creat - show create new slide page
    public function create() {
        return view('backend.slider.create');
    }

    //function edit - show edit slide page
    public function edit($id) {
        $slide = Slide::findOrFail($id);
        return view('backend.slider.update')->with('slide',$slide);
    }

    //delete function - delete slide data and it's image
    public function destroy($id) {
        try {
            DB::beginTransaction();
                $slide = Slide::findOrFail($id);
                $this->delete_if_exist($slide->image);
                $slide->delete();

                Notification::send(Admin::Active()->get(), new SlideNotification(Auth::guard('admin')->user()->id, 'deleted'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }

        return Redirect::route('slider.index');
    }

}