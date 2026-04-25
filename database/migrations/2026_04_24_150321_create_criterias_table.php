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
        Schema::create('criterias', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kriteria');
        // bobot_global akan diisi hasil perhitungan perbandingan kriteria AHP nanti
        $table->float('bobot_global')->nullable()->default(0); 
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
