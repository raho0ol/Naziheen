<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthAssessment extends Model
{
    use HasFactory;


    protected $fillable = [
        'refugee_id',
        'assessment_date',
        'general_health',
        'chronic_conditions',
        'medications',
        'allergies',
        'notes',
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'chronic_conditions' => 'array',
        'medications' => 'array',
        'allergies' => 'array',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
