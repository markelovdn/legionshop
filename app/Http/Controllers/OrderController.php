<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index ()
    {
        return view('orders');
    }

    public function reOrder($id)
    {
       $ids = Order::with('products')->find($id);

        $products=[];
        foreach ($ids->products as $product){
            $products[$product->id] = $product->pivot->quantity;
        }

        session()->put('products', $products);
        session()->save();

        return redirect('basket');
    }
}
