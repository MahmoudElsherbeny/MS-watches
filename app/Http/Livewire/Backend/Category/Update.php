<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\CategoryNotification;
use App\Admin;
use App\Product;
use App\Slide;
use Exception;

class Update extends Component
{
    public $name, $icon, $order, $status;
    public $category;

    public function rules() {
        return [
            'name' => [
                'required', 'max:40', 'min:3', 'regex:/^[a-zA-Z0-9 ]+$/',
                Rule::unique('categories')->ignore($this->category->name, 'name'),
            ],
            'order' => 'required|numeric|max:15|min:1'
        ];
    }

    public function mount() {
        $this->name = $this->category->name;
        $this->icon = $this->category->icon;
        $this->order = $this->category->order;
        $this->status = $this->category->status;
    }

    public function render()
    {
        return view('livewire.backend.category.update');
    }

    public function update() {
        $this->validate();
        try {
            DB::beginTransaction();

                $this->category->name = $this->name;
                $this->category->icon = $this->icon;
                $this->category->order = $this->order;
                $this->category->status = $this->status;

                if($this->category->isDirty()) {
                    if($this->category->isDirty('status')) {
                        //update products,slides status dependes on category status
                        Slide::Where('link', $this->category->id)->update(['status' => $this->category->status]);
                        $this->category->products()->update(['status' => $this->category->status]);
                        foreach($this->category->products as $product){
                            $product->banners()->update(['status' => $this->category->status]);
                        }
                    }
                    $this->category->save();

                    Notification::send(Admin::Active()->get(), new CategoryNotification(Auth::guard('admin')->user()->id, 'added'));
                    $this->emit('notifications');
                    Session::flash('success','Category Updated Successfully');
                }
                else {
                    Session::flash('error','No Changes To Update');
                }

                //logs stored when updated by CategoryObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }
    }

}