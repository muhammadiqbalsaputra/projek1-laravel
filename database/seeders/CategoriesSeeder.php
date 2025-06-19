<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::insert(
            [
                [
                    'name' => 'Electronics',
                    'slug' => 'electronics',
                    'description' => 'Electronic gadgets and devices',
                    'image' => 'https://placehold.co/300x300?text=Electronics'
                ],
                [
                    'name' => 'Books',
                    'slug' => 'books',
                    'description' => 'Various kinds of books',
                    'image' => 'https://placehold.co/300x300?text=Books'
                ],
                [
                    'name' => 'Clothing',
                    'slug' => 'clothing',
                    'description' => 'Men and women clothing',
                    'image' => 'https://placehold.co/300x300?text=Clothing'
                ],
                [
                    'name' => 'Home & Kitchen',
                    'slug' => 'home-kitchen',
                    'description' => 'Home appliances and kitchenware',
                    'image' => 'https://placehold.co/300x300?text=Home+%26+Kitchen'
                ],
                [
                    'name' => 'Sports',
                    'slug' => 'sports',
                    'description' => 'Sports equipment and accessories',
                    'image' => 'https://placehold.co/300x300?text=Sports'
                ],
            ]
        );

    }

}
