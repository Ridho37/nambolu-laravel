<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // app/Models/Product.php
    // app/Models/Product.php
    public static function getRecentProducts($limit = 3)
    {
        return self::latest()->take($limit)->get();
    }

    public function category()
    {
        return $this-> belongsTo(Category::class);
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
    ];
}