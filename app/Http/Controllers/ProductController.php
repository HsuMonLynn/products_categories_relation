<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::when($search = request('search'), function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->orWhereHas('categories', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
            
        $products->appends (array ('search' => $search));
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        return view('products.create',compact('product','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories_id' => 'required'
        ]);
            
        $product = Product::create([
            'name'=> $request->name
        ]);
        $product->categories()->attach($request->categories_id);
    
        return redirect()
            ->route('products.index')
            ->with('success', 'Products created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $productCategories = $product->categories->pluck('id');

        return view('products.edit',compact('product','categories','productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories_id' => 'required'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name'=> $request->name
        ]);

        $product->categories()->sync($request->categories_id);
    
        return redirect()
            ->route('products.index')
            ->with('success', 'Products updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        $product->categories()->detach();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Deleted successfully.');
    }
}
