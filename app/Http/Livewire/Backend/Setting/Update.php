<?php

namespace App\Http\Livewire\Backend\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Setting;

class Update extends Component
{
    use WithFileUploads;

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
            $filename = 'setting/logo.'.$this->logo->getClientOriginalExtension();
            $existInStorage = Storage::exists($filename);
            if($existInStorage) {
                Storage::Delete($filename);
            }
            $this->validate(['logo' => 'max:4000|mimes:jpeg,bmp,png,jpg,ico']);
            $filename = 'logo.'.$this->logo->getClientOriginalExtension();
            $path = $this->logo->storeAs('setting', $filename);
            Setting::Where('name','logo')->update(['value' => $path]);
        }
        if($this->image) {
            $filename = 'setting/image.'.$this->image->getClientOriginalExtension();
            $existInStorage = Storage::exists($filename);
            if($existInStorage) {
                Storage::Delete($filename);
            }
            $this->validate(['image' => 'max:8000|mimes:jpeg,bmp,png,jpg']);
            $filename = 'image.'.$this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('setting', $filename);
            Setting::Where('name','image')->update(['value' => $path]);
        }
        if($this->video) {
            $filename = 'setting/video.'.$this->video->getClientOriginalExtension();
            $existInStorage = Storage::exists($filename);
            if($existInStorage) {
                Storage::Delete($filename);
            }
            $this->validate(['video' => 'max:8000|mimes:mp4,webm,mvp']);
            $filename = 'video.'.$this->video->getClientOriginalExtension();
            $path = $this->video->storeAs('setting', $filename);
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
