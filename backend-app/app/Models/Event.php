<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'date', 'time', 'location', 'category', 'thumbnail_image', 'event_map_image'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function userTickets($userId)
    {
        return $this->tickets()->where('user_id', $userId);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
