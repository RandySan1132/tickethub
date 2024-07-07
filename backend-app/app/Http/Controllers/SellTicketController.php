<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellTicketController extends Controller
{
    public function show(Event $event)
    {
        return view('sell-event', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        Ticket::create([
            'type' => $request->ticket_type,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'event_id' => $event->id,
            'user_id' => Auth::id(), // Store the ID of the currently authenticated user
        ]);

        return redirect()->route('events.show', $event->id)->with('success', 'Ticket added successfully.');
    }
}
