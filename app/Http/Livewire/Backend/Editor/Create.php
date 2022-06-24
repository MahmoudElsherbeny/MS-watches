<?php

namespace App\Http\Livewire\Backend\Editor;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Mail\newEditorMail;
use App\Admin;

class Create extends Component
{
    public $name, $email, $password, $role, $status;

    protected $rules = [
        'name' => 'required|max:30|min:3|regex:/^[a-zA-Z0-9 ]+$/',
        'email' => 'required|email',
        'password' => 'required|min:6'
    ];

    public function mount() {
        $this->role = 'editor';
        $this->status = 'active';
    }

    //function store - store editor data into database
    public function store() {
        
        $this->validate();
        //check if the editor already exist or not
        if(Admin::Where('name',$this->name)->OrWhere('email',$this->email)->count() == 0) {

            $editor = Admin::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $this->role,
                'status' => $this->status,
                'hash' => Str::random(60),
            ]);

            if($editor) {
                Mail::to($editor->email)->send(new newEditorMail($editor,$this->password));
            }

            //logs stored when created by category observer in app\observers

            Session::flash('success','user added successfully');
        }
        else {
            Session::flash('error','username or email already exist');
        }
        
    }

    public function render()
    {
        return view('livewire.backend.editor.create');
    }
}
