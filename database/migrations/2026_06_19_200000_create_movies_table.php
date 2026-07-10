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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');                // Judul film (Teks pendek)
            $table->string('Genre');                // Genre film (Teks pendek)
            $table->integer('duration');            // Durasi dalam menit (Angka)
            $table->year('release_year');           // Tahun rilis
            $table->string('poster_path')->nullable(); // Menyimpan nama/path file gambar poster
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
