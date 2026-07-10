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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke user yang login (jika ada sistem login)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // Menghubungkan ke jadwal film yang dipilih
        $table->foreignId('showtime_id')->constrained()->onDelete('cascade');
        
        $table->string('booking_code')->unique(); // Contoh: TKT-20260708-XYZ
        $table->integer('total_price');
        $table->enum('status', ['pending', 'success', 'cancelled'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
