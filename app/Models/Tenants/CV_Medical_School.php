<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV_Medical_School extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution',
        'yearStart',
        'monthStart',
        'yearEnd',
        'monthEnd',
    ];
}
