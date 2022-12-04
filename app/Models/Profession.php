<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function templates()
    {
        return $this->hasMany(Template::class, 'profession_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function title()
    {
        return $this->hasMany(Title::class);
    }
}
