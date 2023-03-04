<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV_Experience extends Model
{
    use HasFactory;

    protected $fillable = [
            'institution',
            'city_id',
            'yearStart',
            'monthStart',
            'yearEnd',
            'monthEnd',
            'activities',
    ];

    protected $casts = [
        'activities' => 'array'
    ];
}
