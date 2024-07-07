<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contactUs()
    {
        return view('contact-us');
    }

    public function submitContactForm(Request $request)
    {
        // Validate and process the form data here
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        // Process the form data, e.g., send an email, save to database, etc.

        return redirect()->route('contact-us')->with('success', 'Thank you for contacting us!');
    }

    public function aboutUs()
    {
        return view('about-us');
    }
}
