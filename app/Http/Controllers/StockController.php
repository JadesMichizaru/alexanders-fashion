<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->orderBy('stock', 'asc')
            ->paginate(15);

        $totalProducts = Product::count();
        $lowStockCount = Product::where('stock', '<', 10)->count();
        $outOfStockCount = Product::where('stock', 0)->count();

        return view(
            'admin.stock.index',
            compact(
                'products',
                'totalProducts',
                'lowStockCount',
                'outOfStockCount',
            ),
        );
    }

    public function adjust(Request $request, Product $product)
    {
        $request->validate([
            'adjustment' => 'required|integer',
            'reason' => 'required|string',
        ]);

        $oldStock = $product->stock;
        $product->stock += $request->adjustment;
        $product->save();

        // Log stock adjustment
        StockMovement::create([
            'product_id' => $product->id,
            'old_stock' => $oldStock,
            'new_stock' => $product->stock,
            'adjustment' => $request->adjustment,
            'reason' => $request->reason,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Stok berhasil disesuaikan');
    }

    public function lowStock()
    {
        $products = Product::where('stock', '<', 10)
            ->where('is_active', true)
            ->orderBy('stock', 'asc')
            ->get();

        return view('admin.stock.low-stock', compact('products'));
    }
}
