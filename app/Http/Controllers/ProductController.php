<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withCount('orderItems')->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

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

    private function generateSKU($category)
    {
        $prefix = strtoupper(substr($category, 0, 3));
        $unique = strtoupper(uniqid());
        return $prefix . '-' . $unique;
    }
}
