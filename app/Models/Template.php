<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'profession_id', 'imageUrl', 'approved', 'styleFile'
    ];

    public function profession()
    {
        return $this->belongsTo('App\Models\Profession', 'profession_id', 'id');
    }
}
