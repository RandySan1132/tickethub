<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class MyListingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch active listings
        $activeListings = Listing::where('user_id', $user->id)
            ->where('quantity', '>', 0)
            ->with('event')
            ->get();

        // Fetch listings with orders (sold listings)
        $soldListings = Listing::where('user_id', $user->id)
            ->whereHas('orders')
            ->with(['event', 'orders.user'])
            ->get();

        return response()->json([
            'activeListings' => $activeListings,
            'soldListings' => $soldListings,
        ]);
    }

    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        return response()->json($listing);
    }

    public function update(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string',
        ]);

        $listing = Listing::findOrFail($request->listing_id);
        $listing->update($request->only(['price', 'quantity', 'status']));

        return response()->json(['message' => 'Listing updated successfully']);
    }
}
