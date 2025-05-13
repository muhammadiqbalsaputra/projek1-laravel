<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products'; // Sesuaikan dengan nama tabel di database
        
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'price',
        'stock',
        'description',
        'image',
        'image_url',
    ];
}
