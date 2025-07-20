<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'user_id', // jika kamu menyimpan informasi pengguna
    ];

    // ✅ Relasi ke item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // (Opsional) Jika kamu menggunakan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
