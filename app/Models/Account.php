<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'phone',
        'address',
        'avatar',
        'is_active',
        'email_verified_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke Sale
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Relasi ke View
    public function views()
    {
        return $this->hasMany(ViewModel::class, 'user_id');
    }
}
