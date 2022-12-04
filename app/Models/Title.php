<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'profession_id'];

    public function profession()
    {
        return $this->belongsTo('App\Models\Profession', 'profession_id', 'id');
    }
}
