<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        // Statistik untuk dashboard
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $lowStockProducts = Product::where('stock', '<', 10)->count();
        $outOfStockProducts = Product::where('stock', '<=', 0)->count();

        // Data produk untuk ditampilkan di tabel
        $products = Product::latest()->paginate(10);

        // Produk dengan stok menipis (untuk notifikasi)
        $criticalStockProducts = Product::where('stock', '<', 5)
            ->latest()
            ->take(5)
            ->get();

        // 5 produk terbaru
        $recentProducts = Product::latest()->take(5)->get();

        return view(
            'admin.dashboard',
            compact(
                'totalProducts',
                'totalStock',
                'lowStockProducts',
                'outOfStockProducts',
                'products',
                'criticalStockProducts',
                'recentProducts',
            ),
        );
    }
}
