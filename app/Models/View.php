<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class View extends Model
{
    use HasFactory;

    protected $table = 'views';

    protected $fillable = [
        'page',
        'ip_address',
        'user_agent',
        'user_id',
        'views',
    ];

    protected $casts = [
        'views' => 'integer',
    ];

    // Relasi ke Account
    public function account()
    {
        return $this->belongsTo(Account::class, 'user_id');
    }
}
