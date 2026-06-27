<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id', 
        'showtime_id', 
        'booking_date', 
        'total_price', 
        'payment_status'
    ];
}
