<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Admin;

class EditorController extends Controller
{
    //function index - show editors page and editors live search
    public function index()
    {
        return view('backend.editors.list');
    }

    //function create - show create new editor page
    public function create() {
        return view('backend.editors.create');
    }

    //function edit - show edit editor page
    public function edit($id) {
        $editor = Admin::findOrFail($id);
        return view('backend.editors.update')->with('editor',$editor);
    }

    //function update - update editor permission
    public function update(Request $request, $id) {
        
        try {
            
            $editor = Admin::find($id);
            if($editor && $editor->name != 'admin') {
                $editor->role = $request->input('role');
                $editor->status = $request->input('status');

                if($editor->isDirty()) {
                    $editor->save();
                    Session::flash('success','Editor Permissions Updated Successfully');
                }
                else {
                    Session::flash('error','No Changes To Update');
                }
            }

            return Redirect::back();
            
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }
        
    }


    //function destroy - delete editor and his data
    public function destroy($id) {
        $editor = Admin::find($id);
        if($editor && $editor->name != 'admin') {
            if($editor->image) {
                $existInStorage = Storage::exists($editor->image);
                $existInStorage ? Storage::Delete($editor->image) : '';
            }
            $editor->delete();
        }

        return Redirect::route('editor.index');
    }

}
