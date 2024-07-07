<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
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

        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);

        $groupedTickets = $event->tickets->groupBy(function ($ticket) {
            return $ticket->type . '|' . $ticket->price;
        })->map(function ($group) {
            return [
                'price' => $group->first()->price,
                'quantity' => $group->sum('quantity'),
                'ids' => $group->pluck('id')->toArray(),
            ];
        });

        return response()->json([
            'event' => $event,
            'groupedTickets' => $groupedTickets,
        ]);
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
    
        return response()->json($event);
    }
}
