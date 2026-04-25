<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCriteria extends Model
{
    protected $fillable = ['criteria_id', 'nama_sub', 'nilai'];

    // Relasi: Sub-Kriteria ini milik sebuah Kriteria
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
}
