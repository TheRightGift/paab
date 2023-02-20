<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(Contact $contact)
 */
class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'email', 'address'];
}
