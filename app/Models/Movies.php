<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = [
        'title', 
        'Genre', 
        'duration', 
        'release_year', 
        'poster_path'
    ];
}