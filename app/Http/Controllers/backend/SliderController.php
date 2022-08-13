<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use App\Slide;
use App\Traits\ImageFunctions;

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
        $slide = Slide::findOrFail($id);
        $this->delete_if_exist($slide->image);
        $slide->delete();
        
        return Redirect::route('slider.index');
    }

}
