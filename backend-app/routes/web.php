<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SellTicketController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AnalyticsController;

// Event routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('/events/{id}/store-ticket', [EventController::class, 'storeTicket'])->name('events.storeTicket');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::patch('/events/{id}/images/{type}', [EventController::class, 'updateImage'])->name('events.updateImage');
});

// Admin routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    // User management routes
    Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.edit-role');
    Route::post('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Analytics route
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
});

// Order routes
Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');

// Authentication routes
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Registration routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Ticket routes
Route::post('events/{event}/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::patch('events/{event}/tickets', [TicketController::class, 'update'])->name('tickets.update');
Route::delete('events/{event}/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
Route::delete('events/{event}/tickets', [TicketController::class, 'destroyAll'])->name('tickets.destroyAll');
Route::delete('events/{event}/tickets/type/{ticketType}/{price}', [TicketController::class, 'destroyByType'])->name('tickets.destroyByType');
Route::delete('events/{event}/tickets/all/type/{ticketType}/{price}', [TicketController::class, 'destroyAllByType'])->name('tickets.destroyAllByType');
Route::patch('events/{event}/images/{type}', [EventController::class, 'updateImage'])->name('events.updateImage');

Route::post('/events/{event}', [SellTicketController::class, 'store'])->name('sell-tickets.store');
