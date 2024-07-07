<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{

public function store(Request $request, $eventId)
{
    $request->validate([
        'ticket_type' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]);

    $user = Auth::user();

    Ticket::create([
        'event_id' => $eventId,
        'user_id' => $user->id, // Make sure to save the user_id
        'type' => $request->ticket_type,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    return redirect()->route('my-listings')->with('success', 'Ticket added successfully');
}

}
