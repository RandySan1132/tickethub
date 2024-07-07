<?php

namespace App\Http\Controllers;

use App\Models\PaymentOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $paymentOptions = PaymentOption::where('user_id', $user->id)->get();

        return response()->json(['user' => $user, 'paymentOptions' => $paymentOptions]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'for' => 'required|string|in:buying,selling',
            'details' => 'required|array',
            'type' => 'required|string|in:card,paypal',
        ]);

        $user = Auth::user();

        PaymentOption::create([
            'user_id' => $user->id,
            'for' => $request->input('for'),
            'details' => json_encode($request->input('details')),
            'type' => $request->input('type'),
        ]);

        return response()->json(['message' => 'Payment option added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'for' => 'required|string|in:buying,selling',
            'details' => 'required|array',
            'type' => 'required|string|in:card,paypal',
        ]);

        $paymentOption = PaymentOption::findOrFail($id);
        $paymentOption->update([
            'for' => $request->input('for'),
            'details' => json_encode($request->input('details')),
            'type' => $request->input('type'),
        ]);

        return response()->json(['message' => 'Payment option updated successfully.']);
    }

    public function destroy($id)
    {
        $paymentOption = PaymentOption::findOrFail($id);
        $paymentOption->delete();

        return response()->json(['message' => 'Payment option removed successfully.']);
    }
}
