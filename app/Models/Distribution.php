<?php

namespace App\Models;

use App\Models\Refugee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'refugee_id',
        'resource_id',
        'quantity',
        'distribution_date',
        'distributed_by',
        'notes',
    ];

    protected $casts = [
        'distribution_date' => 'date',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    public function distributedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'distributed_by');
    }
}
