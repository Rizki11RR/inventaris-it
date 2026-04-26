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
        Schema::create('criteria_comparisons', function (Blueprint $table) {
        $table->id();
        $table->foreignId('criteria_id1')->constrained('criterias')->onDelete('cascade');
        $table->foreignId('criteria_id2')->constrained('criterias')->onDelete('cascade');
        $table->double('nilai'); // Menyimpan skala 1-9 atau kebalikannya
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_comparisons');
    }
};
