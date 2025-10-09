<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display products (filtered by category if provided)
     */
    public function index(Request $request)
    {
        // Get all categories to show as buttons
        $categories = Category::all();

        // Get selected category (from ?category=slug)
        $categorySlug = $request->query('category');

        // Build query
        $query = Product::with('category');

        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $products = $query->orderBy('created_at', 'desc')->get();

        return view('home', compact('products', 'categories', 'categorySlug'));
    }

    public function create()
{
    $categories = Category::all();
    return view('admin.add-product', compact('categories'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $product = new Product($validated);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
    }

    $product->save();

    return redirect()->route('products.create')->with('success', '✅ Product added successfully!');
}

}
