<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Account;
use App\Models\ViewModel; // atau nama model Anda
use App\Models\Sale;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        // Statistik Penjualan
        $totalSalesToday = Order::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum('total');

        $totalSalesMonth = Order::whereBetween('created_at', [
            $monthStart,
            Carbon::now(),
        ])
            ->where('status', 'completed')
            ->sum('total');

        // Laba Kotor dan Bersih
        $grossProfit = $this->calculateGrossProfit($monthStart);
        $netProfit = $this->calculateNetProfit($monthStart);

        // Produk Stok Rendah
        $lowStockProducts = Product::where('stock', '<', 10)
            ->where('is_active', true)
            ->take(5)
            ->get();

        // Chart Data
        $salesChartData = $this->getSalesChartData();

        return view(
            'admin.dashboard',
            compact(
                'totalSalesToday',
                'totalSalesMonth',
                'grossProfit',
                'netProfit',
                'lowStockProducts',
                'salesChartData',
            ),
        );
    }

    private function calculateGrossProfit($startDate)
    {
        $orders = Order::where('status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->with('items')
            ->get();

        $revenue = $orders->sum('total');
        $cogs = 0; // Cost of Goods Sold

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $cogs += $item->cost_price * $item->quantity;
            }
        }

        return $revenue - $cogs;
    }

    private function calculateNetProfit($startDate)
    {
        $grossProfit = $this->calculateGrossProfit($startDate);
        $expenses = Expense::where('date', '>=', $startDate)->sum('amount');

        return $grossProfit - $expenses;
    }

    private function getSalesChartData()
    {
        $dates = collect();
        $sales = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $dates->push($date->format('M Y'));

            $monthSales = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'completed')
                ->sum('total');

            $sales->push($monthSales);
        }

        return [
            'labels' => $dates,
            'data' => $sales,
        ];
    }
}
