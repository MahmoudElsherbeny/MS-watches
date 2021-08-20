<?php

namespace App\Http\Livewire\Backend\Setting;

use Livewire\Component;
use App\Setting;
use Session;
use Redirect;

class Update extends Component
{
    public $name;
    public $address;
    public $phone;
    public $email;
    public $facebook;
    public $twitter;
    public $instagram;

    protected $rules = [
        'name' => 'required|max:8|regex:/^[a-zA-Z0-9 ]+$/',
        'address' => 'required|max:50',
        'phone' => 'required|numeric',
        'email' => 'required|email',
        'facebook' => 'required|url',
        'twitter' => 'required|url',
        'instagram' => 'required|url',
    ];

    public function mount() {
        $this->name = Setting::getSettingValue('name');
        $this->address = Setting::getSettingValue('address');
        $this->phone = Setting::getSettingValue('phone');
        $this->email = Setting::getSettingValue('email');
        $this->facebook = Setting::getSettingValue('facebook');
        $this->twitter = Setting::getSettingValue('twitter');
        $this->instagram = Setting::getSettingValue('instagram');
    }

    public function update() {
        
        $this->validate();

        Setting::Where('name','name')->update(['value' => $this->name]);
        Setting::Where('name','address')->update(['value' => $this->address]);
        Setting::Where('name','phone')->update(['value' => $this->phone]);
        Setting::Where('name','email')->update(['value' => $this->email]);
        Setting::Where('name','facebook')->update(['value' => $this->facebook]);
        Setting::Where('name','twitter')->update(['value' => $this->twitter]);
        Setting::Where('name','instagram')->update(['value' => $this->instagram]);

        //logs stored when updated by category observer in app\observers

        Session::flash('success','Setting Updated Successfully');
        
        return Redirect::route('setting.edit');
        
    }

    public function render()
    {
        return view('livewire.backend.setting.update');
    }
}
