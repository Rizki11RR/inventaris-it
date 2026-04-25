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
       Schema::create('sub_criterias', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel criterias. Jika kriteria dihapus, sub-kriteria ikut terhapus.
        $table->foreignId('criteria_id')->constrained('criterias')->onDelete('cascade');
        $table->string('nama_sub'); // Contoh: "Sangat Baik", "Rusak"
        $table->float('nilai');    // Nilai angka, contoh: 5, 1, atau 0.75
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_criterias');
    }
};
