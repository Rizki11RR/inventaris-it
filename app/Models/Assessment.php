<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = ['asset_id', 'total_score', 'rekomendasi'];

    public function asset() {
        return $this->belongsTo(Asset::class);
    }
}
