<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperProject extends Model
{
    use HasFactory;

    protected $fillable = ['developer_id', 'zip_url', 'approved', 'paid', 'name'];

    public function developer() {
        return $this->belongsTo(Developer::class);
    }
}
