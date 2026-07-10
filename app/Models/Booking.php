<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $guarded = [];

    /**
     * Hubungan relasi ke data User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hubungan relasi ke Jadwal Film (Showtimes)
     */
    public function showtime(): BelongsTo
    {
        return $this->belongsTo(Showtimes::class, 'showtime_id');
    }

    /**
     * Hubungan relasi ke detail rincian kursi
     */
    public function details(): HasMany
    {
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }
}