<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class ApiController extends Controller
{
    public function getEvents()
    {
        return Event::all();
    }

    public function createEvent(Request $request)
    {
        // Validate and create event
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    public function updateEvent(Request $request, $id)
    {
        // Validate and update event
        $event = Event::findOrFail($id);
        $event->update($request->all());
        return response()->json($event, 200);
    }

    public function deleteEvent($id)
    {
        // Delete event
        Event::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
