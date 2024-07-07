<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events', compact('events'));
    }

    public function getEventsByCategory(Request $request, $category)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $events = Event::query();

        if ($category != 'all') {
            $events->where('category', $category);
        }

        if ($startDate && $endDate) {
            $events->whereBetween('date', [$startDate, $endDate]);
        }

        $events = $events->get();

        return response()->json($events->map(function ($event) {
            return [
                'id' => $event->id,
                'name' => $event->name,
                'thumbnail_image' => $event->thumbnail_image,
                'location' => $event->location,
                'date' => $event->date,
                'time' => $event->time,
                'category' => $event->category
            ];
        }));
    }

    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);

        // Group tickets by type and price, and sum their quantities
        $groupedTickets = $event->tickets->groupBy(function ($ticket) {
            return $ticket->type . '|' . $ticket->price;
        })->map(function ($group) {
            return [
                'price' => $group->first()->price,
                'quantity' => $group->sum('quantity'),
                'ids' => $group->pluck('id')->toArray(),
            ];
        });

        return view('event-details', compact('event', 'groupedTickets'));
    }

    public function searchEvents(Request $request)
    {
        $query = $request->get('query');
        $events = Event::where('name', 'LIKE', "%{$query}%")->get();
    
        return response()->json($events);
    }
    
    public function showSellEventForm($eventId)
    {
        $event = Event::findOrFail($eventId);
    
        return view('sell-event', compact('event'));
    }
}
