<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_id',
        'ticket_type', // Add this field
        'quantity',
        'price',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::info('Listing creating', ['model' => $model]);
        });

        static::created(function ($model) {
            Log::info('Listing created', ['model' => $model]);
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
