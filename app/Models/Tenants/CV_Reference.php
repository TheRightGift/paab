<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV_Reference extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position', 'location', 'phone',];
}
