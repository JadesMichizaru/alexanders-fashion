<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'product_id',
        'account_id',
        'quantity',
        'price',
        'total',
        'status',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke Account
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Scope untuk filter bulan ini
    public function scopeThisMonth($query)
    {
        return $query
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'));
    }

    // Scope untuk filter status completed
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
