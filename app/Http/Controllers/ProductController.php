<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Location;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $locations = Location::all();
        $category = Category::all();
        // dd($products->toArray());
        return view('product.index', ['products' => $products, 'locations' => $locations, 'category' => $category]);
    }
    public function search(Request $request)
    {
        $query = $request->q;
        $percentage = session('price_increase', 0);

        $products = Product::where('name', 'like', "%$query%")
            ->limit(10)
            ->get()
            ->map(function ($product) use ($percentage) {
                $product->adjusted_price = round($product->price * (1 + $percentage / 100), 2);
                return $product;
            });

        return response()->json($products);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        // dd($id);
        // $product = Product::findOrFail($id);
        $percentage = session('price_increase', 0);

        $product = Product::findOrFail($id);
        $product->adjusted_price = round($product->price * (1 + $percentage / 100), 2);
        // dd($product->toArray());
        return view('product.searchresult', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    // public function getProducts(Request $request)
    // {
    //     $percentage = session('price_increase', 0);

    //     $products = Product::paginate(8)->through(function ($product) use ($percentage) {
    //         $product->adjusted_price = round($product->price * (1 + $percentage / 100), 2);
    //         return $product;
    //     });
    //     return response()->json($products);
    // }
    public function getProducts(Request $request)
    {
        $percentage = session('price_increase', 0);

        $query = Product::query();

        // Apply category filter if passed
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(8)->through(function ($product) use ($percentage) {
            $product->adjusted_price = round($product->price * (1 + $percentage / 100), 2);
            return $product;
        });

        return response()->json($products);
    }
}
