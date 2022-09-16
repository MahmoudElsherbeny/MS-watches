<?php

namespace App\Http\Livewire\Backend\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

use App\Traits\ImageFunctions;
use App\Notifications\SettingNotification;
use App\Setting;
use App\Admin;
use Exception;

class Update extends Component
{
    use WithFileUploads, ImageFunctions;

    public $name, $address, $location, $phone, $email, $about, $facebook, $twitter, $instagram;
    public $logo, $image, $video;

    private $update_values = ['name', 'address', 'location', 'phone', 'email', 'about', 'facebook', 'twitter', 'instagram'];
    private $update_files = ['logo', 'image', 'video'];

    protected $rules = [
        'name' => 'required|max:8|regex:/^[a-zA-Z0-9 ]+$/',
        'address' => 'required|max:50',
        'location' => 'required|url',
        'phone' => 'required|numeric',
        'email' => 'required|email',
        'about' => 'required',
        'facebook' => 'required|url',
        'twitter' => 'required|url',
        'instagram' => 'required|url',
        'logo' => 'nullable|max:4000|mimes:jpeg,bmp,png,jpg,ico',
        'image' => 'nullable|max:8000|mimes:jpeg,bmp,png,jpg',
        'video' => 'nullable|max:8000|mimes:mp4,webm,mvp',
    ];

    public function mount() {
        foreach($this->update_values as $value) {
            $this->$value = Setting::getSettingValue($value);
        }
    }

    public function render()
    {
        return view('livewire.backend.setting.update');
    }

    public function update() {
        $this->validate();
       
        try {
            DB::beginTransaction();
                foreach($this->update_values as $value) {
                    $setting = Setting::Where('name',$value)->first();
                    $setting->value = $this->$value;
                    $setting->save();
                }
                foreach($this->update_files as $file) {
                    $setting = Setting::Where('name', $file)->first();
                    if($this->$file) {
                        $setting->value ? $this->delete_if_exist($setting->value) : '';
                        $name = 'site_'.$file.time();
                        $path = $this->store_unique_image_path($name, $this->$file, 'setting');
                        $setting->value = $path;
                        $setting->save();
                    }
                }

                Notification::send(Admin::Active()->role('admin')->get(), new SettingNotification(Auth::guard('admin')->user()->id));
                $this->emit('notifications');
                
                //logs stored when updated by settingObserver in app\observers
                Session::flash('success','Website Setting Updated Successfully');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }     
    }

}