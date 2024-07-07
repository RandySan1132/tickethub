<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ListingsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $listing = Listing::create([
            'event_id' => $request->event_id,
            'user_id' => Auth::id(),
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        Ticket::create([
            'event_id' => $listing->event_id,
            'type' => $listing->ticket_type,
            'price' => $listing->price,
            'quantity' => $listing->quantity,
            'user_id' => $listing->user_id,
        ]);

        return redirect()->back()->with('success', 'Tickets listed successfully.');
    }
}
