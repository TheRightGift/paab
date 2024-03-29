<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantOtp extends Model
{
    use HasFactory;
    protected $fillable = ['tenant_id', 'otp'];
}
