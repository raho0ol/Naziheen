<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movement extends Model
{
    use HasFactory;
    protected $fillable = [
        'refugee_id',
        'from_location',
        'to_location',
        'departure_date',
        'arrival_date',
        'reason',
        'transportation_method',
        'status',
        'notes',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'arrival_date' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
