<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'asset_id', 
        'user_id', 
        'total_score', 
        'rekomendasi', 
        'tanggal_penilaian'
    ];

    // Tambahkan casting di sini
    protected $casts = [
        'tanggal_penilaian' => 'datetime',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
