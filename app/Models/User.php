<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'othername',
        'username',
        'password',
        'zipcode',
        'phone',
        'email',
        'plan',
        'provider_id',
        'provider',
        'role',
        'emailVerification',
        'accessToken',
        'title_id',
        'city_id',
        'access_token',
        'visits'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function profession()
    {
        return $this->belongsTo('App\Models\User', 'profession_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }
}
