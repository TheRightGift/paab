<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'profession_id'
    ];

    public function profession()
    {
        return $this->belongsTo('App\Models\Profession', 'profession_id', 'id');
    }
}
