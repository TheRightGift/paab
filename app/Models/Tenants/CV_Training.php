<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV_Training extends Model
{
    use HasFactory;

    protected $fillable = [
       'institution',
        'location',
        'yearStart',
        'monthStart',
        'yearEnd',
        'monthEnd',
        'specialty',
        'sub_specialty',
        'type',
    ];
}
