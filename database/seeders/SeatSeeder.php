<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat data contoh kursi baris A dan B untuk Studio 1
        $seats = ['A1', 'A2', 'A3', 'A4', 'A5', 'B1', 'B2', 'B3', 'B4', 'B5'];

        foreach ($seats as $seatNumber) {
            Seat::create([
                'studio_id' => 1, 
                'seat_number' => $seatNumber,
                'is_available' => true, // true artinya kursi kosong/tersedia
            ]);
        }
    }
}