<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VocationalTraining extends Model
{
    use HasFactory;
    protected $fillable = [
        'refugee_id',
        'program_name',
        'program_type',
        'start_date',
        'end_date',
        'institution',
        'skills_acquired',
        'certification',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'skills_acquired' => 'array',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
