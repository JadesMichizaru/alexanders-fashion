<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = ['Baju', 'Celana', 'Jaket', 'Aksesoris'];
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colors = ['Hitam', 'Putih', 'Merah', 'Biru', 'Hijau', 'Kuning'];

        return view(
            'admin.products.create',
            compact('categories', 'sizes', 'colors'),
        );
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $data['slug'] = Str::slug($request->name);
        $data['sku'] = $this->generateSKU($request->category);

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = ['Baju', 'Celana', 'Jaket', 'Aksesoris'];
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colors = ['Hitam', 'Putih', 'Merah', 'Biru', 'Hijau', 'Kuning'];

        return view(
            'admin.products.edit',
            compact('product', 'categories', 'sizes', 'colors'),
        );
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $data['slug'] = Str::slug($request->name);
        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Hapus image jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    /**
     * Generate unique SKU for product.
     */
    private function generateSKU($category)
    {
        $prefix = strtoupper(substr($category, 0, 3));
        $unique = strtoupper(uniqid());
        return $prefix . '-' . $unique;
    }
}
