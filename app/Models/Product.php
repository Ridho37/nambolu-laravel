<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'price',
        'stock',
        'image',
    ];
    
    /**
     * Relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // ... (method lain yang mungkin sudah Anda miliki)


    // ============================================================== //
    // ==== TAMBAHKAN METHOD DI BAWAH INI KE DALAM CLASS PRODUCT ==== //
    // ============================================================== //

    /**
     * Local Scope untuk memfilter produk berdasarkan request.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters (contoh: ['search' => 'kue', 'category' => 'bolu'])
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan pencarian (jika ada parameter 'search' di URL)
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%');
        });

        // Filter berdasarkan kategori (jika ada parameter 'category' di URL)
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });
    }
}