<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menggunakan Schema::create karena kita ingin membuat tabel baru dari nol
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel movies (pastikan tabel movies sudah dibuat sebelum ini)
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            
            // Kolom-kolom baru yang ingin Anda tambahkan
            $table->string('cinema_name');
            $table->string('studio_name');
            $table->dateTime('show_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Jika di-rollback, langsung hapus satu tabel sekaligus
        Schema::dropIfExists('showtimes');
    }
};