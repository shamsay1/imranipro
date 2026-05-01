<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('product', compact('products'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('images/'), $filename);

            $imagePath = 'images/'.$filename;
        }

        Product::create([
            'user_id' => Auth::id(),
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imagePath,
            'category' => $request->category,
            'status' => 'Active',
        ]);

        return back()->with('success', 'Product added successfully');
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'category' => $request->category,
        ]);

        return back()->with('success', 'Product updated successfully');
    }
}
