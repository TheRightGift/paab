<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webcreation extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'domainName', 'firstname', 'lastname', 'email', 'web_creation', 'site_active', 'tenant_id'];
}
