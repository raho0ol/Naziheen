<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalNeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'refugee_id',
        'medical_condition',
        'medication_name',
        'dosage',
        'frequency',
        'start_date',
        'end_date',
        'prescribing_doctor',
        'notes',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
