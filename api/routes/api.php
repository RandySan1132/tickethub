<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyOrdersController;
use App\Http\Controllers\MyListingsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SellTicketController;
use App\Http\Controllers\ListingsController;

// Auth routes
Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

// Public routes
Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API']);
});

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/category/{category}', [EventController::class, 'getEventsByCategory']);
Route::get('/events/{id}', [EventController::class, 'show'])->middleware('auth:sanctum');
Route::get('/search', [SearchController::class, 'search']);
Route::get('/search-events', [EventController::class, 'searchEvents']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'profile']);
    Route::post('/user/update', [UserController::class, 'updateProfile']);
    
    Route::get('/settings', [SettingsController::class, 'show']);
    Route::put('/settings', [SettingsController::class, 'update']);
    Route::post('/password-confirm', [SettingsController::class, 'confirmPassword']);
    
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::post('/addresses/{address}', [AddressController::class, 'update']);
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);
    
    Route::get('/my-orders', [MyOrdersController::class, 'index']);
    Route::get('/my-listings', [MyListingsController::class, 'index']);
    Route::get('/my-sales', [SalesController::class, 'index']);
    
    Route::resource('payments', PaymentController::class)->only(['index', 'store', 'update', 'destroy']);
    
    Route::get('/sell-tickets/{event}', [SellTicketController::class, 'show']);
    Route::post('/tickets/{event}', [SellTicketController::class, 'store']);
    
    Route::get('/sell-tickets/{eventId}', [ListingsController::class, 'create']);
    Route::post('/sell-tickets/{eventId}', [ListingsController::class, 'store']);
    
    Route::get('/checkout', [CheckoutController::class, 'showCheckout']);
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout']);
    
    Route::post('/listings', [ListingsController::class, 'store']);
    Route::get('/my-listings/{id}/edit', [MyListingsController::class, 'edit']);
    Route::post('/my-listings/update', [MyListingsController::class, 'update']);
});

// Additional public routes
Route::get('/about-us', [PageController::class, 'aboutUs']);
Route::get('/blogs', [PageController::class, 'blogs']);
Route::get('/event-organizers', [PageController::class, 'eventOrganizers']);
Route::get('/contact-us', [PageController::class, 'contactUs']);
Route::post('/contact-us/submit', [PageController::class, 'submitContactForm']);
