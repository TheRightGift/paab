<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TenantUser extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['user_id', 'accessToken'];
}
