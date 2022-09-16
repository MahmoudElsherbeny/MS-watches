<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\CategoryNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Category;
use App\Slide;
use Exception;

class Categorieslist extends Component
{
    use ImageFunctions;
    public $category_search, $sort_field, $sort_dir;

    public function mount() {
        $this->sort_field = 'created_at';
        $this->sort_dir = 'desc';
    }

    public function render()
    {
        $categories = Category::Search($this->category_search)->OrderBy($this->sort_field, $this->sort_dir)->get();
        return view('livewire.backend.category.categorieslist')->with('categories',$categories);
    }

    public function sortBy($field) {
        $this->sort_field = $field;
        $this->sort_dir = $this->sort_dir == 'asc' ? 'desc' : 'asc';
    }

    //function destroy - delete category and it's all products
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        try {
            DB::beginTransaction();
                $slides = Slide::Where('link', $category->id)->get();
                foreach ($category->products as $prod) {
                    foreach ($prod->product_images as $img) {
                        $this->delete_if_exist($img->image);
                        $img->delete();
                    }
                    foreach($prod->banners as $banner) {
                        $this->delete_if_exist($banner->image);
                        $banner->delete();
                    }
                    $prod->product_reviews->each->delete();
                    $prod->products_stores->each->delete();
                    $prod->delete();
                }

                $slides->each->delete();
                $category->delete();

                Notification::send(Admin::Active()->get(), new CategoryNotification(Auth::guard('admin')->user()->id, 'deleted with it\'s related'));
                $this->emit('notifications');

                //logs stored when deleted by CategoryObserver in app\observers
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }
}