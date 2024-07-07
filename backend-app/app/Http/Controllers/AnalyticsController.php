<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Event;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalSales = Order::sum('price');
        $totalOrders = Order::count();
        $totalTicketsSold = Order::sum('quantity');

        // Sales by Event
        $salesByEvent = Event::select('events.*')
            ->selectRaw('SUM(orders.price) AS total_sales')
            ->selectRaw('COUNT(orders.id) AS total_orders')
            ->selectRaw('SUM(orders.quantity) AS total_tickets_sold')
            ->join('listings', 'events.id', '=', 'listings.event_id')
            ->join('orders', 'listings.id', '=', 'orders.listing_id')
            ->groupBy('events.id')
            ->get();

        // Sample Data for Charts
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $ticketSalesData = [10, 20, 15, 30, 40, 25, 35];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $revenueData = [1000, 1200, 1500, 1300, 1800, 2000, 2200, 2100, 2300, 2400, 2500, 2600];

        return view('analytics', compact('totalSales', 'totalOrders', 'totalTicketsSold', 'salesByEvent', 'daysOfWeek', 'ticketSalesData', 'months', 'revenueData'));
    }
}
