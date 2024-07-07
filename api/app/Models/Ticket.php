<?php

// app/Models/Ticket.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'type', 'price', 'quantity'
    ];

    public static function boot()
    {
        parent::boot();

        // When a ticket is created, update or create the corresponding listing
        static::created(function ($ticket) {
            Listing::updateOrCreate(
                [
                    'event_id' => $ticket->event_id,
                    'ticket_type' => $ticket->type,
                    'price' => $ticket->price,
                ],
                [
                    'quantity' => $ticket->quantity,
                    'user_id' => auth()->id(),
                ]
            );
        });

        // When a ticket is updated, update the corresponding listing
        static::updated(function ($ticket) {
            $listing = Listing::where('event_id', $ticket->event_id)
                ->where('ticket_type', $ticket->type)
                ->where('price', $ticket->price)
                ->first();

            if ($listing) {
                $listing->quantity = $ticket->quantity;
                $listing->save();
            }
        });

        // When a ticket is deleted, delete the corresponding listing
        static::deleted(function ($ticket) {
            Listing::where('event_id', $ticket->event_id)
                ->where('ticket_type', $ticket->type)
                ->where('price', $ticket->price)
                ->delete();
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
