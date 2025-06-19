<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Binafy\LaravelCart\Cartable;

class Products extends Model implements Cartable
{
    public function category()
    {
        return $this->belongsTo(Categories::class, 'product_category_id');
    }
    public function getPrice(): float
    {
        return $this->price;
    }

}
