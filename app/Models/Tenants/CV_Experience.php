<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV_Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
            'institution',
            'location',
            'yearStart',
            'monthStart',
            'yearEnd',
            'monthEnd',
            'activities',
    ];
}
