<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini

class Maintenance extends Model
{
    // Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'asset_id', 
        'tanggal_perawatan', 
        'detail_perbaikan', 
        'dokumentasi_kerusakan', 
        'biaya'
    ];

    /**
     * Relasi ke tabel Assets (Satu histori perawatan milik satu perangkat)
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}