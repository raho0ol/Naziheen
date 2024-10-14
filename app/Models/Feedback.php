<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'refugee_id',
        'type',
        'subject',
        'description',
        'status',
        'assigned_to',
        'resolution',
    ];

    public function refugee(): BelongsTo
    {
        return $this->belongsTo(Refugee::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
