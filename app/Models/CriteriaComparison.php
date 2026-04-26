<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaComparison extends Model
{
    protected $table = 'criteria_comparisons';

    protected $fillable = [
        'criteria_id1', 
        'criteria_id2', 
        'nilai'
    ];
}
