<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function store(Request $request, Event $event)
    {
        \Log::info('Ticket Store Request:', $request->all());

        $request->validate([
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        Ticket::create([
            'event_id' => $event->id,
            'type' => $request->ticket_type,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('events.show', $event->id)->with('success', 'Ticket added successfully.');
    }



    public function update(Request $request, Event $event)
    {
        $request->validate([
            'ticket_type' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'new_price' => 'required|numeric',
            'new_quantity' => 'required|integer',
        ]);

        Ticket::where('event_id', $event->id)
            ->where('type', $request->ticket_type)
            ->where('price', $request->ticket_price)
            ->delete();

        for ($i = 0; $request->new_quantity > 0 ? $i < $request->new_quantity : $i < 1; $i++) {
            Ticket::create([
                'event_id' => $event->id,
                'type' => $request->ticket_type,
                'price' => $request->new_price,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('events.show', $event->id)->with('success', 'Tickets updated successfully.');
    }


    public function destroy(Event $event, $ticketId)
    {
        $ticket = Ticket::where('event_id', $event->id)->findOrFail($ticketId);
        $ticket->delete();

        return redirect()->route('events.show', $event->id)->with('success', 'Ticket deleted successfully.');
    }

    public function destroyAll(Event $event)
    {
        Ticket::where('event_id', $event->id)->delete();

        return redirect()->route('events.show', $event->id)->with('success', 'All tickets deleted successfully.');
    }

    public function destroyByType(Event $event, $ticketType, $price)
    {
        $ticket = Ticket::where('event_id', $event->id)
            ->where('type', $ticketType)
            ->where('price', $price)
            ->first();

        if ($ticket) {
            $ticket->delete();
        }

        return redirect()->route('events.show', $event->id)->with('success', 'One ticket removed successfully.');
    }

    public function destroyAllByType(Event $event, $ticketType, $price)
    {
        Ticket::where('event_id', $event->id)
            ->where('type', $ticketType)
            ->where('price', $price)
            ->delete();

        return redirect()->route('events.show', $event->id)->with('success', 'All tickets of the specified type removed successfully.');
    }

    public function purchase(Request $request, Ticket $ticket)
{
    $user = Auth::user();
    $quantity = $request->input('quantity');

    // Ensure there are enough tickets available
    if ($quantity > $ticket->quantity) {
        return redirect()->route('events.show', $ticket->event->id)->with('error', 'Not enough tickets available.');
    }

    $order = new Order([
        'user_id' => $user->id,
        'order_id' => uniqid('order_'),
        'event_name' => $ticket->event->name,
        'event_id' => $ticket->event_id, // Ensure event_id is set
        'date' => now(),
        'quantity' => $quantity,
        'price' => $ticket->price * $quantity,
        'status' => 'purchased'
    ]);

    // Update ticket quantity
    $ticket->quantity -= $quantity;
    $ticket->save();

    // Save order
    $order->save();

    return redirect()->route('events.show', $ticket->event->id)->with('success', 'Ticket purchased successfully.');
}

}
