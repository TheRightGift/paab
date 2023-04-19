<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiniBlog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'imageUrl', 'body'];
}
