<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantUser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'accessToken'];
}
