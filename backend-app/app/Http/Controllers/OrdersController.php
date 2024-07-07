<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentOption;

class OrdersController extends Controller
{
    public function index()
    {
        // // Ensure only admins can access this page
        // if (auth()->user()->role !== 'admin') {
        //     return redirect()->route('home')->with('error', 'Unauthorized access');
        // }

        $orders = Order::with(['user', 'listing.event', 'paymentOption'])->get();
        return view('orders.index', compact('orders'));
    }
}
