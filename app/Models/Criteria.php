<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    protected $fillable = ['nama_kriteria', 'bobot_global'];

    // Relasi: Satu Kriteria punya banyak Sub-Kriteria (Bobot)
    public function subCriterias(): HasMany
    {
        return $this->hasMany(SubCriteria::class);
    }
}
