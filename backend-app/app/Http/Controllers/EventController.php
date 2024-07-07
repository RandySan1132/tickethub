<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        Log::info('EventController index method called');
    
        $events = Event::all();
        Log::info('Events fetched', ['events' => $events]);
    
        return view('index', compact('events'));
    }
    

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
            'category' => 'required|string',
            'thumbnail_image' => 'required|image',
            'event_map_image' => 'required|image',
        ]);

        $thumbnailImagePath = $request->file('thumbnail_image')->store('images', 'public');
        $eventMapPath = $request->file('event_map_image')->store('images', 'public');

        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'category' => $request->category,
            'thumbnail_image' => $thumbnailImagePath,
            'event_map_image' => $eventMapPath,
        ]);

        return redirect()->route('events.show', $event->id)->with('success', 'Event created successfully.');
    }

    public function show($id)
    {
        $event = Event::with(['tickets.orders.user'])->findOrFail($id);
        $user = Auth::user(); // Get the authenticated user
    
        // Group tickets by type and calculate total quantity and available quantity
        $groupedTickets = $event->tickets->groupBy('type')->map(function ($tickets) {
            $totalQuantity = $tickets->sum('quantity');
            $soldQuantity = $tickets->flatMap->orders->sum('quantity');
            return [
                'price' => $tickets->first()->price,
                'total_quantity' => $totalQuantity,
                'available_quantity' => $totalQuantity - $soldQuantity,
            ];
        });
    
        // Calculate sold tickets and event revenue
        $totalTicketsSold = 0;
        $totalRevenue = 0;
        $soldTickets = [];
    
        foreach ($event->tickets as $ticket) {
            foreach ($ticket->orders as $order) {
                $totalTicketsSold += $order->quantity;
                $totalRevenue += $order->quantity * $order->price;
    
                $soldTickets[] = [
                    'ticket_type' => $ticket->type,
                    'quantity' => $order->quantity,
                    'sold_to' => $order->user->name,
                    'date' => $order->created_at->format('Y-m-d'),
                ];
            }
        }
    
        // Fetch tickets listed by the user
        $userTickets = Listing::where('event_id', $event->id)->get();
    
        return view('events.show-event', compact('event', 'groupedTickets', 'soldTickets', 'totalTicketsSold', 'totalRevenue', 'userTickets'));
    }
    

    // In storeTicket method of EventController

public function storeTicket(Request $request, $eventId)
{
    $request->validate([
        'ticket_type' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]);

    $event = Event::findOrFail($eventId);
    \Log::info('Event found', ['event' => $event]);

    // Check if a ticket with the same type and price already exists for this event
    $existingTicket = Ticket::where('event_id', $eventId)
        ->where('type', $request->ticket_type)
        ->where('price', $request->price)
        ->first();

    if ($existingTicket) {
        \Log::info('Existing ticket found', ['existingTicket' => $existingTicket]);

        // Update the quantity of the existing ticket
        $existingTicket->quantity += $request->quantity;
        $existingTicket->save();

        // Update the corresponding listing
        $listing = Listing::where('ticket_id', $existingTicket->id)->first();
        if ($listing) {
            $listing->quantity += $request->quantity;
            $listing->save();
            \Log::info('Listing updated', ['listing' => $listing]);
        } else {
            // Create a new listing if it doesn't exist
            Listing::create([
                'ticket_id' => $existingTicket->id,
                'event_id' => $event->id,
                'user_id' => Auth::id(),
                'ticket_type' => $request->ticket_type,
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);
            \Log::info('New listing created for existing ticket');
        }
    } else {
        \Log::info('Creating new ticket');

        // Create a new ticket
        $ticket = Ticket::create([
            'type' => $request->ticket_type,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'event_id' => $event->id,
            'user_id' => Auth::id(),
        ]);

        \Log::info('Creating new listing for new ticket');

        // Create a new listing
        Listing::create([
            'ticket_id' => $ticket->id,
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'ticket_type' => $request->ticket_type,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    }

    return redirect()->route('events.show', $event->id)->with('success', 'Ticket added successfully.');
}


    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }

    public function updateImage(Request $request, $id, $type)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $event = Event::findOrFail($id);

        $path = $request->file('image')->store('images', 'public');

        if ($type == 'thumbnail') {
            $event->thumbnail_image = $path;
        } elseif ($type == 'event_map') {
            $event->event_map_image = $path;
        }

        $event->save();

        return redirect()->route('events.show', $event->id)->with('success', ucfirst($type) . ' image updated successfully.');
    }
}
