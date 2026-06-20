<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{ 
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
