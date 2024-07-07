<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Event;
use App\Models\Listing;
use DB;

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

        // Prepare sales data for the chart
        $salesData = [
            'labels' => [],
            'data' => []
        ];

        $salesByDate = $sales->groupBy(function($sale) {
            return $sale->created_at->format('Y-m-d');
        });

        foreach ($salesByDate as $date => $sales) {
            $salesData['labels'][] = $date;
            $salesData['data'][] = $sales->sum('price');
        }

        return view('my-sales', compact('user', 'sales', 'totalSales', 'totalOrders', 'ticketsSold', 'salesData'));
    }
}
