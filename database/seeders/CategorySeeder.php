<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'artists',
            'photographers',
            'writers',
            'design',
            'advertising',
            'music',
            'cinema',
            'travel',
            'psychology',
            'culture',
            'folk_art',
            'family',
            'kindness',
            'animals',
            'nostalgia',
            'insanity',
            'science',
            'cuisine'
        ];

        foreach ($categories as $category) {
            $categoryModel = new Category();
            $categoryModel->name = $category;
            $categoryModel->save();
        }
    }
}
