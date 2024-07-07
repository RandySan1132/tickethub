<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $address = $user->address;
        return response()->json(compact('user', 'address'));
    }

    public function update(Request $request)
    {
        Log::info('Update method called.');
        $user = Auth::user();
        Log::info('Authenticated user:', ['user' => $user]);

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        } catch (ValidationException $e) {
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        Log::info('Request data:', ['name' => $request->name, 'email' => $request->email]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
            Log::info('Password updated.');
        }

        $user->save();
        Log::info('User saved.');

        $addressFields = $request->only(['address_line1', 'address_line2', 'city', 'state', 'postal_code', 'country']);
        if (array_filter($addressFields)) {
            if ($user->address) {
                $user->address->update($addressFields);
                Log::info('Address updated.');
            } else {
                $user->address()->create($addressFields);
                Log::info('Address created.');
            }
        }

        return response()->json(['status' => 'Profile updated successfully']);
    }

    public function confirmPassword(Request $request)
    {
        $user = Auth::user();
        $password = $request->password;

        if (Hash::check($password, $user->password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
