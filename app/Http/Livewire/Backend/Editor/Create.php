<?php

namespace App\Http\Livewire\Backend\Editor;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Mail\newEditorMail;
use App\Admin;
use Exception;

class Create extends Component
{
    public $name, $email, $password, $role, $status;

    protected $rules = [
        'name' => 'required|max:30|min:3|regex:/^[a-zA-Z0-9 ]+$/|unique:admins,name',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|min:6'
    ];

    public function mount() {
        $this->role = 'editor';
        $this->status = 'active';
    }

    public function render()
    {
        return view('livewire.backend.editor.create');
    }

    //function store - store editor data into database
    public function store() {
        $this->validate();

        try {
            DB::beginTransaction();

                $editor = Admin::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'role' => $this->role,
                    'status' => $this->status,
                    'hash' => Str::random(60),
                ]);

                $editor ? Mail::to($editor->email)->send(new newEditorMail($editor,$this->password)) : '';

                Session::flash('success','user added successfully');
                //logs stored when created by  observer in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }
}
