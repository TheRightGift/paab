<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    use HasFactory;
    protected $fillable = ['about', 'CV', 'lastname', 'photo', 'firstname', 'lastname'];
}
