<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyRelation extends Model
{
    use HasFactory;
    protected $fillable = [
        'refugee_id',
        'related_refugee_id',
        'relation_type',
        'notes',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class, 'refugee_id');
    }

    public function relatedRefugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class, 'related_refugee_id');
    }
}
