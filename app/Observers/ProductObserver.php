<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {

        // dd('Observer "CREATED berhasil dipanggil"', 'produk yang dibuat: ', $product);
        ActivityLog::created([
            'user_id'       => Auth::id(),
            'action'        => 'CREATED',
            'description'   => "Menambahkan produk baru: '{$product->name}'"
        ]);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        ActivityLog::created([
            'user_id'       => Auth::id(),
            'action'        => 'UPDATED',
            'description'   => "Memperbarui produk: '{$product->name}'"
        ]);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        ActivityLog::created([
            'user_id'       => Auth::id(),
            'action'        => 'DELETED',
            'description'   => "Menghapus produk: '{$product->name}'"
        ]);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
