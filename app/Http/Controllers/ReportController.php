<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function financial(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        // Revenue
        $revenue = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed')
            ->sum('total');

        // COGS
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed')
            ->with('items')
            ->get();

        $cogs = 0;
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $cogs += $item->cost_price * $item->quantity;
            }
        }

        // Gross Profit
        $grossProfit = $revenue - $cogs;

        // Expenses
        $expenses = Expense::whereBetween('date', [
            $startDate,
            $endDate,
        ])->get();
        $totalExpenses = $expenses->sum('amount');

        // Net Profit
        $netProfit = $grossProfit - $totalExpenses;

        // Expenses by Category
        $expensesByCategory = $expenses
            ->groupBy('category')
            ->map(function ($group) {
                return $group->sum('amount');
            });

        // Daily Sales for Chart
        $dailySales = [];
        for ($day = 1; $day <= $endDate->day; $day++) {
            $date = Carbon::create($year, $month, $day);
            $dailySales[$date->format('d M')] = Order::whereDate(
                'created_at',
                $date,
            )
                ->where('status', 'completed')
                ->sum('total');
        }

        return view(
            'admin.reports.financial',
            compact(
                'revenue',
                'cogs',
                'grossProfit',
                'expenses',
                'totalExpenses',
                'netProfit',
                'expensesByCategory',
                'dailySales',
                'month',
                'year',
            ),
        );
    }

    public function profitLoss(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);

        $monthlyData = [];

        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();

            // Revenue
            $revenue = Order::whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->sum('total');

            // COGS
            $cogs = $this->calculateCOGS($startDate, $endDate);

            // Expenses
            $expenses = Expense::whereBetween('date', [
                $startDate,
                $endDate,
            ])->sum('amount');

            $monthlyData[] = [
                'month' => $startDate->format('F'),
                'revenue' => $revenue,
                'cogs' => $cogs,
                'gross_profit' => $revenue - $cogs,
                'expenses' => $expenses,
                'net_profit' => $revenue - $cogs - $expenses,
            ];
        }

        return view(
            'admin.reports.profit-loss',
            compact('monthlyData', 'year'),
        );
    }

    private function calculateCOGS($startDate, $endDate)
    {
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed')
            ->with('items')
            ->get();

        $cogs = 0;
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $cogs += $item->cost_price * $item->quantity;
            }
        }

        return $cogs;
    }
}
