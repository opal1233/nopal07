<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sepatu Futsal',
                'description' => 'Sepatu khusus futsal dengan grip dan kontrol optimal.'
            ],
            [
                'name' => 'Sepatu Sepakbola',
                'description' => 'Sepatu sepakbola untuk lapangan rumput.'
            ],
            [
                'name' => 'Sepatu Lari',
                'description' => 'Sepatu lari ringan dan nyaman untuk performa terbaik.'
            ],
            [
                'name' => 'Sneakers',
                'description' => 'Sneakers stylish sehari-hari dengan sentuhan sporty.'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}