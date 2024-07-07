<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class MyOrdersController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $currentOrders = Order::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->with('listing.event')
            ->get();

        $pastOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->with('listing.event')
            ->get();

        return response()->json([
            'user' => $user,
            'currentOrders' => $currentOrders,
            'pastOrders' => $pastOrders
        ]);
    }
}
