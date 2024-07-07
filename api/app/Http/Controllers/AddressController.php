<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $address = $user->address;
        return response()->json(compact('user', 'address'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->address) {
            return response()->json(['status' => 'You already have an address'], 400);
        }

        $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        $user->address()->create($request->all());

        return response()->json(['status' => 'Address added successfully']);
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        $address->update($request->all());

        return response()->json(['status' => 'Address updated successfully']);
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json(['status' => 'Address deleted successfully']);
    }
}
