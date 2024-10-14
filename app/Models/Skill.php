<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'refugee_id',
        'skill_name',
        'skill_level',
        'years_of_experience',
        'certification',
        'last_used',
        'notes',
    ];

    protected $casts = [
        'last_used' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
