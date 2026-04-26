<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    // Mendaftarkan kolom agar bisa disimpan secara otomatis
    protected $fillable = [
        'kode_aset', 
        'nama_perangkat', 
        'category_id', 
        'location_id', 
        'vendor_id', 
        'status_id', 
        'tanggal_pengadaan', 
        'harga_beli', 
        'catatan'
    ];

    // Relasi ke tabel-tabel yang sudah Anda buat migrasinya
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function location(): BelongsTo { return $this->belongsTo(Location::class); }
    public function vendor(): BelongsTo { return $this->belongsTo(Vendor::class); }
    public function status(): BelongsTo { return $this->belongsTo(Status::class); }
}