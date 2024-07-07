<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class SalesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sales = $user->sales()
            ->with('listing.event', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSales = $sales->sum('price');
        $totalOrders = $sales->count();
        $ticketsSold = $sales->sum('quantity');

        $salesData = [
            'labels' => [],
            'data' => []
        ];

        $salesByDate = $sales->groupBy(function ($sale) {
            return $sale->created_at->format('Y-m-d');
        });

        foreach ($salesByDate as $date => $sales) {
            $salesData['labels'][] = $date;
            $salesData['data'][] = $sales->sum('price');
        }

        return response()->json([
            'user' => $user,
            'sales' => $sales,
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'ticketsSold' => $ticketsSold,
            'salesData' => $salesData
        ]);
    }
}
