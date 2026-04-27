<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Menambahkan kolom skor_ahp dengan tipe decimal/double untuk menyimpan hasil hitung AHP
            $table->decimal('skor_ahp', 8, 4)->nullable()->after('status_id');
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('skor_ahp');
        });
    }
};
