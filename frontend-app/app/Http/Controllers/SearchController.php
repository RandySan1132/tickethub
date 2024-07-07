<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Assuming 'name' is a column in your 'events' table
        $events = Event::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('location', 'LIKE', "%$query%")
            ->get();

        return view('search-results', compact('events', 'query'));
    }
}
