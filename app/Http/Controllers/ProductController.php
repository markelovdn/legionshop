<?php

namespace App\Http\Controllers;

use App\Jobs\ExportProducts;
use App\Jobs\ImportCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products ()
    {
        $products = Product::get();
        $categories = Category::all();
        return view('admin.products.products', compact('products', 'categories'));
    }

    public function addProduct ()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function storeProduct (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,bmp,png',
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        $product = new Product();
        $file = $request->file('picture');
        $ext = $file->getClientOriginalExtension();
        $fileName = '/products/'. time() . rand(1000, 9999) . '.' . $ext;
        $file->storeAs('public/img', $fileName);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->picture = $fileName;
        $product->save();
        return redirect()->route('allProducts');
    }

    public function editProduct ($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,bmp,png',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $product = Product::find($request->input('id'));
        $file = $request->file('picture');

        if ($file) {
            Storage::delete('public/img'. $product->picture);
            $ext = $file->getClientOriginalExtension();
            $fileName = '/products/'. time() . rand(1000, 9999) . '.' . $ext;
            $file->storeAs('public/img', $fileName);
            $product->picture = $fileName;
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();
        return redirect()->route('allProducts');
    }

    public function delProduct ($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('allProducts');
    }

    public function exportProducts ()
    {
        ExportProducts::dispatch();
        session()->flash('startExportProducts');
        return back();
    }

//    public function importProducts ()
//    {
//        ImportCategory::dispatch();
//        session()->flash('startExportProducts');
//        return back();
//    }
}
