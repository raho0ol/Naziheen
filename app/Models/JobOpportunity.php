<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobOpportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'description',
        'requirements',
        'location',
        'salary',
        'application_deadline',
        'status',
    ];

    protected $casts = [
        'application_deadline' => 'date',
    ];

    public function refugees(): BelongsToMany
    {
        return $this->belongsToMany(Refugee::class, 'job_applications')
                    ->withPivot('application_date', 'status', 'interview_date', 'notes')
                    ->withTimestamps();
    }
}
