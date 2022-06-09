<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Admin;

class EditorController extends Controller
{
    //function index - show categories page and categories live search
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $editors = Admin::where('name','LIKE','%'.$request->editor_search.'%')->where('email','!=','admin')->orderBY('created_at','DESC')->get();
            $editorCount = count($editors);
            $returnEditors = view('backend.editors.search')->with('editors',$editors)->render();
            return Response()->json(['data'=>$returnEditors, 'count'=>$editorCount]);
        }
        else {
            $editors = Admin::Where('email','!=','admin')->orderBY('created_at','DESC')->get();
            return view('backend.editors.list')->with('editors',$editors);
        }
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
            if($editor != null) {
                $editor->role = $request->input('role');
                $editor->status = $request->input('status');
                $editor->save();

                Session::flash('success','Editor Permissions Updated Successfully');
                return Redirect::back();
            }
            else {
                Session::flash('error','Editor Not Exist');
            }
            
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }
        
    }


    //function destroy - delete editor and his data
    public function destroy($id) {
        $editor = Admin::find($id);
        $editor->delete();

        return Redirect::route('editor.index');
    }

}
