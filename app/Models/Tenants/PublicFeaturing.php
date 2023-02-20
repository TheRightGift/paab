<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method find(PublicFeaturing $public_feature)
 * @method static where(string $string, mixed $id)
 * @method static create($input)
 */
class PublicFeaturing extends Model
{
    use HasFactory;
    protected  $fillable = ['broadcaster', 'title', 'url'];
}
