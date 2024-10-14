<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RecreationalActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'activity_type',
        'start_date',
        'end_date',
        'location',
        'capacity',
        'organizer',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function refugees(): BelongsToMany
    {
        return $this->belongsToMany(Refugee::class, 'recreational_activity_participants')
                    ->withPivot('registration_date', 'attendance', 'feedback')
                    ->withTimestamps();
    }
}
