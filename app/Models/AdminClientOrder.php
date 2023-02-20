<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminClientOrder extends Model
{
    use HasFactory;
    protected $fillable = ['tenant_id', 'user_id', 'email', 'claimed'];
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
