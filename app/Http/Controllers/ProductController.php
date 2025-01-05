<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProductController extends Controller
{
    // Display a listing of the product.
    public function index(Request $request)
    {
        // $products = Product::with('categories')->get();

        $query = Product::query();

        // Search by product name or description
        if ($request->has('search') && $request->search != '') {
            $search = $request->input('search');
            $query->where('pro_name', 'like', '%' . $search . '%')
                  ->orWhere('pro_desc', 'like', '%' . $search . '%');
        }
    
        // Search by selected category
        /*if ($request->has('category') && $request->category != '') {
            $categoryId = $request->input('category');
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }*/

        if ($request->has('search') && $request->search != '') {
            $search = $request->input('search');
            $query->orWhereHas('categories', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
    
        // Fetch the products with categories
        $products = $query->with('categories')->get();
        
        return view('product.index', compact('products'));
    }

    // Show the form for creating a new Product.
    public function create()
    {
        $categories = Category::get();
        return view('product.create', compact('categories'));
    }

    // Store a newly created Product in the database.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pro_name' => 'required|string|max:255',
            'pro_price' => 'required|numeric',
            'mobile_number' => 'required|numeric',
            'pro_image' => 'required',
            'pro_desc' => 'required|string',
            'categories' => 'required|array', // Ensure categories is an array
            // 'categories.*' => 'exists:categories,id', // Validate each category ID exists
        ]);

        // Handle file upload
        if ($request->hasFile('pro_image')) {
            $filePath = $request->file('pro_image')->store('products', 'public');
            $validated['pro_image'] = $filePath;
        }
        
            $categories = $validated['categories'];
            unset($validated['categories']);
            // Create the product
            $product = Product::create($validated);

            // Attach categories to the product
            $product->categories()->sync($request->categories);
  
            return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    // Display the specified Product.
    public function show(Product $Product)
    {
        $this->authorize('show'); // Checks if the user can show this Product
        
        if (!$Product) {
            return abort(404, 'Product not found');
        }

        return view('product.show', compact('Product'));
    }

    // Show the form for editing the specified Product.
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('product.edit', compact('product', 'categories'));
    }
    
    // Update the specified Product in the database.

    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'pro_name' => 'required|string|max:255',
            'pro_price' => 'required|numeric',
            'mobile_number' => 'required|numeric',
            // 'pro_image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Optional file upload
            'pro_image' => 'nullable', // Optional file upload
            'pro_desc' => 'required|string',
            'categories' => 'required|array', // Ensure categories is an array
            // 'categories.*' => 'exists:categories,id', // Validate each category ID exists
        ]);

        // Handle file upload if a new file is provided
        if ($request->hasFile('pro_image')) {
            $filePath = $request->file('pro_image')->store('products', 'public');
            $validated['pro_image'] = $filePath;

            // Optionally, delete the old image (if applicable)
            if ($product->pro_image) {
                \Storage::disk('public')->delete($product->pro_image);
            }
        }

        $categories = $validated['categories'];
        unset($validated['categories']);

        // Update the product
        $product->update($validated);

        // Sync categories
        $product->categories()->sync($categories);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    // Remove the specified Product from the database.
    public function destroy(Product $product)
    {
        if ($product->pro_image) {
            \Storage::disk('public')->delete($product->pro_image);
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}

?>