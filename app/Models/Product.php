<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'price',
        'image',
    ];

    /**
     * Relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Fungsi kustom untuk mengambil produk terbaru.
     */
    public static function getRecentProducts($limit = 3)
    {
        return self::latest()->take($limit)->get();
    }
}