<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiniBlog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'imageUrl', 'body'];
}
