<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Showtimes extends Model
{
    protected $guarded = []; 

    /**
     * Hubungan relasi ke model Movies
     */
    public function movie(): BelongsTo
    {
        // Menghubungkan ke Movies menggunakan foreign key 'movie_id'
        return $this->belongsTo(Movies::class, 'movie_id');
    }
}