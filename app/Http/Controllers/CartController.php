<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Cart::create([
            'name' => $request->productname,
            'description' => $request->productdescription,
            'image_link' => $request->productimage,
            'price' => $request->productprice,
            'categories_id' => $request->categoryId,
            'product_id' => $request->id,
        ]);
        return redirect('/')->with("success", 'Item Added To Cart Successfully.');
    }

    public function show()
    {
        $cartItems = Cart::all();
        $category = Category::all();
        return response()->json($cartItems);
    }
    public function increase(Request $request, string $id)
    {
        $prd = Product::findOrFail($id);
        // dd('increase function called ', $id, $prd);
        Cart::create([
            'name' => $prd->name,
            'description' => $prd->description,
            'image_link' => $prd->image_link,
            'price' => $prd->price,
            'categories_id' => $prd->category_id,
            'product_id' => $prd->id,
        ]);
        return response()->json(['success' => true]);
    }

    public function decrease(Request $request, string $id)
    {
        // Decrease quantity (remove if 0)
        $prd = Cart::where('product_id', $id)->first();
        // dd($prd);
        if ($prd) {
            $prd->delete();
            return response()->json(['success' => true]);
        }
    }

    public function remove(Request $request)
    {
        // Remove item from cart
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
