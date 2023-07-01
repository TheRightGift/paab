<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'NUBAN', 'cv_url', 'bank'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function projects()
    {
        return $this->hasMany(DeveloperProject::class);
    }
}
