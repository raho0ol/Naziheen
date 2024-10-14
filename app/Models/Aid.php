<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aid extends Model
{
    use HasFactory;

    protected $fillable = [
        'refugee_id',
        'type',
        'description',
        'amount',
        'date_provided',
    ];

    protected $casts = [
        'date_provided' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }
}
