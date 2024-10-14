<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychologicalAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'refugee_id',
        'assessment_date',
        'assessor_name',
        'mental_state',
        'stress_level',
        'anxiety_level',
        'depression_level',
        'ptsd_symptoms',
        'suicidal_thoughts',
        'sleep_quality',
        'appetite',
        'social_interactions',
        'coping_mechanisms',
        'recommendations',
        'follow_up_date',
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'follow_up_date' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}