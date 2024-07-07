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


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/sell', [SellController::class, 'index'])->name('sell.index');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/events/category/{category}', [EventController::class, 'getEventsByCategory'])->name('events.category');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show')->middleware('auth'); // Protect this route
Route::get('/mock-event', function () {
    return view('event-details');
});



Route::get('/search', [SearchController::class, 'search'])->name('search');


Route::get('/sell-tickets', function () {
    return view('sell-tickets');
});


Route::get('/search-events', [EventController::class, 'searchEvents']);



Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/my-profile', [UserController::class, 'profile'])->name('my-profile');
    Route::get('/my-profile/edit', [UserController::class, 'editProfile'])->name('my-profile.edit');
    Route::post('/my-profile/update', [UserController::class, 'updateProfile'])->name('my-profile.update');

    Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/password-confirm', [SettingsController::class, 'confirmPassword'])->name('password.confirm');

    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::post('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');

    Route::get('/my-orders', [MyOrdersController::class, 'index'])->name('my-orders');
    Route::get('/my-listings', [MyListingsController::class, 'index'])->name('my-listings');
    Route::get('/my-sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/customer-support', [SupportController::class, 'index'])->name('customer-support');
        
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::resource('payments', PaymentController::class)->only(['index', 'store', 'update', 'destroy']);


    Route::get('/sell-tickets/{event}', [EventController::class, 'showSellEventForm']);
    Route::post('/tickets/{event}', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/sell-tickets/event/{event}', [SellTicketController::class, 'show'])->name('sell-tickets.event');
    Route::post('/tickets/{event}', [SellTicketController::class, 'store'])->name('tickets.store');

    Route::get('/sell-tickets/{eventId}', [ListingsController::class, 'create'])->name('sell-tickets.event');
Route::post('/sell-tickets/{eventId}', [ListingsController::class, 'store'])->name('tickets.store');

Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::get('/confirmation', function () {
    return view('confirmation');
})->name('confirmation');

Route::post('/listings', [ListingsController::class, 'store'])->name('listings.store');
Route::get('/my-listings/{id}/edit', [MyListingsController::class, 'edit'])->name('my-listings.edit');
Route::post('/my-listings/update', [MyListingsController::class, 'update'])->name('my-listings.update');

});

Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/event-organizers', [PageController::class, 'eventOrganizers'])->name('event-organizers');
Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us/submit', [PageController::class, 'submitContactForm'])->name('contact-us.submit');


