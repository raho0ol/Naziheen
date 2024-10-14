<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'refugee_id',
        'service_type',
        'description',
        'provided_by',
        'provided_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'provided_at' => 'datetime',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }

    public function providedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provided_by');
    }
}
