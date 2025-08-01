<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.index', ['category' => $category]);
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
        $request->validate([
            'productname' => 'required',
            'productprice' => 'required',
            'productdescription' => 'required',
            'productimage' => 'required|image',
            'productcategory' => 'required',
        ]);
        // dd($request->all());
        $imagePath = $request->file('productimage')->store('images', 'public');
        // $imageName = time() . '.' . request()->productimage->getClientOriginalExtension();
        // $path = request()->productimage->move(public_path('images'), $imageName);
        // dd($imagePath);
        Product::create([
            'name' => $request->productname,
            'description' => $request->productdescription,
            'image_link' => $imagePath,
            'price' => $request->productprice,
            'category_id' => $request->productcategory,
        ]);
        return redirect('/admin-dashboard')->with('success', 'Product Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $products = Product::all();
        return view('admin.list', ['products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productEdit = Product::findOrFail($id);
        // dd($productEdit->toArray());
        return view('admin.edit', ['product' => $productEdit]);
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
