<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_category_id', // <- nama kolom yang benar
        'name',
        'price',
        'stock',            // <- pastikan sesuai dengan kolom di migration
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }
}
