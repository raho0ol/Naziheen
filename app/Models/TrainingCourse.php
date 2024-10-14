<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrainingCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'description',
        'start_date',
        'end_date',
        'instructor',
        'location',
        'capacity',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function refugees(): BelongsToMany
    {
        return $this->belongsToMany(Refugee::class, 'refugee_training_course')
                    ->withPivot('enrollment_date', 'completion_status', 'certificate_issued')
                    ->withTimestamps();
    }
}
