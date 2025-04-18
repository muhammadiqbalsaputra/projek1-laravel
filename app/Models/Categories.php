<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    protected $table = 'products'; // Sesuaikan dengan nama tabel kalian }
}
