<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Need extends Model
{
    use HasFactory;

    protected $fillable = [
        'refugee_id',
        'category',
        'description',
        'priority',
        'status',
        'requested_date',
        'fulfilled_date',
    ];

    protected $casts = [
        'requested_date' => 'date',
        'fulfilled_date' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
