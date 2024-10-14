<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'unit',
        'expiry_date',
        'location',
        'notes',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];
}
