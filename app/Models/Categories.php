<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    protected $table = 'product_categories'; // Sesuaikan dengan nama tabel kalian }
}
