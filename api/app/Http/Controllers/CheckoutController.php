<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentOption;
use App\Models\Ticket;

class CheckoutController extends Controller
{
    public function showCheckout(Request $request)
    {
        $event_id = $request->query('event_id');
        $ticket_type = $request->query('ticket_type');
        $price = $request->query('price');
        $quantity = $request->query('quantity');

        $listing = Listing::where('event_id', $event_id)
                          ->where('ticket_type', $ticket_type)
                          ->where('price', $price)
                          ->first();

        $paymentOptions = PaymentOption::where('user_id', Auth::id())->get();

        return response()->json(compact('listing', 'paymentOptions'));
    }

    public function processCheckout(Request $request)
    {
        \Log::info('processCheckout called', ['request' => $request->all()]);

        $user = Auth::user();
        \Log::info('Authenticated user', ['user' => $user]);

        $listing = Listing::findOrFail($request->listing_id);
        \Log::info('Listing found', ['listing' => $listing]);

        if ($request->quantity > $listing->quantity) {
            return response()->json(['error' => 'Not enough tickets available'], 400);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'listing_id' => $listing->id,
            'quantity' => $request->quantity,
            'price' => $listing->price,
            'status' => 'completed',
            'payment_option_id' => $request->payment_option_id,
        ]);

        \Log::info('Order Created: ', $order->toArray());

        $listing->quantity -= $request->quantity;
        if ($listing->quantity == 0) {
            $listing->status = 'sold';
        }
        $listing->save();

        \Log::info('Listing updated', ['listing' => $listing]);

        if ($listing->ticket_id) {
            $ticket = Ticket::findOrFail($listing->ticket_id);
            $ticket->quantity -= $request->quantity;
            $ticket->save();
            \Log::info('Ticket updated', ['ticket' => $ticket]);
        } else {
            \Log::warning('Listing has no ticket_id', ['listing' => $listing]);
        }

        \Log::info('Redirecting to confirmation page');
        return response()->json(['message' => 'Order placed successfully']);
    }

    public function confirmation()
    {
        return response()->json(['message' => 'Order confirmed']);
    }
}
