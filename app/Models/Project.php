<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'budget',
        'manager',
        'location',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
    ];

    public function refugees(): BelongsToMany
    {
        return $this->belongsToMany(Refugee::class, 'project_participants')
                    ->withPivot('role', 'join_date', 'leave_date', 'notes')
                    ->withTimestamps();
    }
}