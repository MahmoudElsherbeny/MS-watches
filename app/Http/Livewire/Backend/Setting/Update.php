<?php

namespace App\Http\Livewire\Backend\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Setting;
use App\Traits\ImageFunctions;

class Update extends Component
{
    use WithFileUploads, ImageFunctions;

    public $name, $address, $phone, $email, $about;
    public $facebook, $twitter, $instagram;
    public $logo, $image, $video;

    private $update_values = ['name', 'address', 'phone', 'email', 'about', 'facebook', 'twitter', 'instagram'];

    protected $rules = [
        'name' => 'required|max:8|regex:/^[a-zA-Z0-9 ]+$/',
        'address' => 'required|max:50',
        'phone' => 'required|numeric',
        'email' => 'required|email',
        'about' => 'required',
        'facebook' => 'required|url',
        'twitter' => 'required|url',
        'instagram' => 'required|url',
    ];

    public function mount() {
        foreach($this->update_values as $value) {
            $this->$value = Setting::getSettingValue($value);
        }
    }

    public function update(Setting $setting) {
        
        $this->validate();
       
        foreach($this->update_values as $value) {
            Setting::Where('name',$value)->update(['value' => $this->$value]);
        }
        if($this->logo) {
            $logo = Setting::select('value')->Where('name','logo')->fisrt();
            $logo ? $this->delete_if_exist($logo) : '';
            
            $this->validate(['logo' => 'max:4000|mimes:jpeg,bmp,png,jpg,ico']);
            $path = $this->store_image_path($this->logo, 'setting');
            Setting::Where('name','logo')->update(['value' => $path]);
        }
        if($this->image) {
            $image = Setting::select('value')->Where('name','image')->fisrt();
            $image ? $this->delete_if_exist($image) : '';

            $this->validate(['image' => 'max:8000|mimes:jpeg,bmp,png,jpg']);
            $path = $this->store_image_path($this->image, 'setting');
            Setting::Where('name','image')->update(['value' => $path]);
        }
        if($this->video) {
            $video = Setting::select('value')->Where('name','video')->fisrt();
            $video ? $this->delete_if_exist($video) : '';

            $this->validate(['video' => 'max:8000|mimes:mp4,webm,mvp']);
            $path = $this->store_image_path($this->imavideoge, 'setting');
            Setting::Where('name','video')->update(['value' => $path]);
        }

        //logs stored when updated by settingObserver in app\observers
        Session::flash('success','Website Setting Updated Successfully');

    }

    public function render()
    {
        return view('livewire.backend.setting.update');
    }
}
