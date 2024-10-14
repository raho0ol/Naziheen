<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refugee extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'id_number',
        'phone_number',
        'family_members',
        'spouse_full_name',
        'spouse_id_number',
        'original_residence',
    ];
}
