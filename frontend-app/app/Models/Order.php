<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'listing_id', 'quantity', 'price', 'status', 'payment_option_id'
    ];

    public static function boot()
    {
        parent::boot();

        // After an order is created, update the quantity in tickets and listings
        static::created(function ($order) {
            $listing = Listing::find($order->listing_id);
            if ($listing) {
                $listing->quantity -= $order->quantity;
                $listing->save();

                $ticket = Ticket::where('event_id', $listing->event_id)
                    ->where('type', $listing->ticket_type)
                    ->where('price', $listing->price)
                    ->first();

                if ($ticket) {
                    $ticket->quantity -= $order->quantity;
                    $ticket->save();
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}


class PaymentOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
