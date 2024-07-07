<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'date', 'time', 'location', 'thumbnail_image', 'event_map_image', 'category'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
