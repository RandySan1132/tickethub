<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        return view('admin.users');
    }

    public function manageEvents()
    {
        return view('admin.events');
    }

    public function manageOrders()
    {
        return view('admin.orders');
    }

    public function viewAnalytics()
    {
        return view('admin.analytics');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
