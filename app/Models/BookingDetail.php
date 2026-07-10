<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingDetail extends Model
{
    protected $guarded = [];

    /**
     * Hubungan relasi kembali ke data utama Booking
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Hubungan relasi ke data Kursi (Seat)
     */
    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }
}