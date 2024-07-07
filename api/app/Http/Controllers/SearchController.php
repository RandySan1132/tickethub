<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $events = Event::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('location', 'LIKE', "%$query%")
            ->get();

        return response()->json(['events' => $events, 'query' => $query]);
    }
}
