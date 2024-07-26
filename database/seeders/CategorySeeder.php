<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => [
                'uz' => 'Stol',
                'ru' => 'Стол'
            ]
        ]);

        Category::create([
            'name' => [
                'uz' => 'Divan',
                'ru' => 'Диван'
            ]
        ]);

        $category = Category::create([
            'name' => [
                'uz' => 'Kreslo',
                'ru' => 'Кресло'
            ]
        ]);


        $category->childCategories()->create([
            'name' => [
                'uz' => 'ofis',
                'ru' => ' ru ofis'
            ]
        ]);

        $category->childCategories()->create([
            'name' => [
                'uz' => 'gaming',
                'ru' => ' ru gaming'
            ]
        ]);

        Category::create([
            'name' => [
                'uz' => 'Yotoq',
                'ru' => 'Кроваты'
            ]
        ]);

        Category::create([
            'name' => [
                'uz' => 'Stul',
                'ru' => 'Стул'
            ]
        ]);
    }
}
