<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'refugee_id',
        'education_level',
        'field_of_study',
        'skills',
        'languages',
        'certifications',
        'work_experience',
    ];

    protected $casts = [
        'skills' => 'array',
        'languages' => 'array',
        'certifications' => 'array',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
