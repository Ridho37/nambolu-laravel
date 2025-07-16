<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;

    protected $fillable = ['action', 'description', 'admin_name'];

    // Ini tidak perlu kalau kamu tidak override
    public $timestamps = true;
}
