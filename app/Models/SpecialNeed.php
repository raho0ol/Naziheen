<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'refugee_id',
        'need_type',
        'description',
        'severity',
        'diagnosis_date',
        'treatment_plan',
        'assistive_devices',
        'notes',
    ];

    protected $casts = [
        'diagnosis_date' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
