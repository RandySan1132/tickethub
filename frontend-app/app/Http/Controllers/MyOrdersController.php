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
            ->where('status', '!=', 'completed') // Assuming 'completed' means past order
            ->with('listing.event')
            ->get();

        $pastOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed') // Assuming 'completed' means past order
            ->with('listing.event')
            ->get();

        return view('my-orders', [
            'user' => $user,
            'currentOrders' => $currentOrders,
            'pastOrders' => $pastOrders
        ]);
    }
}
