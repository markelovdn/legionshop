<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Jobs\ImportCategory;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index ()
    {
        $users = User::get();
        $orders = Order::get();
        return view('admin.index', compact('users', 'orders'));
    }

    public function allUsers ()
    {
        $users = User::get();
        return view('admin.users.users', compact('users'));
    }

    public function allCategories ()
    {
        $categories = Category::with('products')->get();
        return view('admin.categories.categories', compact('categories'));
    }

    public function editCategory ($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function storeCategory (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,bmp,png',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $category = new Category();
        if ($request->file('picture')){
            $file = $request->file('picture');
            $ext = $file->getClientOriginalExtension();
            $fileName = '/category/'. time() . rand(1000, 9999) . '.' . $ext;
            $file->storeAs('public/img', $fileName);
            $category->picture = $fileName;
        } else {
            $category->picture = '/nocategory.png';
        }

        $category->name = $request->input('name');
        $category->description = $request->input('description');

        $category->save();
        return redirect()->route('allCategories');
    }

    public function updateCategory (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,bmp,png',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $category = Category::find($request->input('id'));
        $file = $request->file('picture');
        $input = $request->all();

        if ($file) {
            Storage::delete('public/img'. $category->picture);
            $ext = $file->getClientOriginalExtension();
            $fileName = '/category/'. time() . rand(1000, 9999) . '.' . $ext;
            $file->storeAs('public/img', $fileName);
            $category->picture = $fileName;
        }

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return redirect()->route('allCategories');
    }

    public function enterAsUser ($userId) {
        Auth::loginUsingId($userId);
        return redirect()->route('home');
    }

    public function exportCategories ()
    {
        ExportCategories::dispatch();
        session()->flash('startExportCategories');
        return back();
    }

    public function importCategories ()
    {
        ImportCategory::dispatch();
        session()->flash('startImportCategories');
        return back();
    }

    public function delCategory ($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back();
    }

    public function users ()
    {
        return User::paginate(2);
    }

}
