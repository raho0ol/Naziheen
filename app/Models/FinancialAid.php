<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialAid extends Model
{
    use HasFactory;
    protected $fillable = [
        'refugee_id',
        'amount',
        'currency',
        'aid_type',
        'date_provided',
        'provider',
        'purpose',
        'status',
        'notes',
    ];

    protected $casts = [
        'date_provided' => 'date',
        'amount' => 'decimal:2',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
