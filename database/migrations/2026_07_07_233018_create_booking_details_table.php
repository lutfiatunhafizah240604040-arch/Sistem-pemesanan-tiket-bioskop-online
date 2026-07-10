<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('booking_details', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel bookings di atas
        $table->foreignId('booking_id')->constrained()->onDelete('cascade');
        // Menghubungkan ke kursi yang dipilih
        $table->foreignId('seat_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
