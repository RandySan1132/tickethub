<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Address;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function sales()
    {
        return $this->hasManyThrough(Order::class, Listing::class);
    }

    public function paymentOptions()
    {
        return $this->hasMany(PaymentOption::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
