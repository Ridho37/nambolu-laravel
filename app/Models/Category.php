<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    

    protected $fillable =[
        'name',
        'description',
        'slug'
    ];
}
