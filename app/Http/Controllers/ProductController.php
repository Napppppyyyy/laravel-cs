<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get all products
     */
    public function getProducts()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }

    /**
     * Add a new product
     */
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:255'],
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        return response()->json([
            'message' => 'Product successfully created!',
            'product' => $product
        ]);
    }

    /**
     * Edit an existing product
     */
    public function editProduct(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:255'],
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        return response()->json([
            'message' => 'Product successfully updated!',
            'product' => $product
        ]);
    }

    /**
     * Delete a product
     */
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product successfully deleted!']);
    }
}