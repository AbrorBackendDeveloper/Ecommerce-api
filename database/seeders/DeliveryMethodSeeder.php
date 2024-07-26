<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryMethod::create([
            'name' => [
                'uz' => 'tekin',
                'ru' => 'бесплатно',
            ],
            'estimated_time' => [
                'uz' => '5 kun',
                'ru' => 'ru 5 kun',
            ],
            'sum' => 0
        ]);
        
        DeliveryMethod::create([
            'name' => [
                'uz' => 'standart',
                'ru' => 'ru standart',
            ],
            'estimated_time' => [
                'uz' => '3 kun',
                'ru' => 'ru 3 kun',
            ],
            'sum' => 40000
        ]);
        
        DeliveryMethod::create([
            'name' => [
                'uz' => 'tez',
                'ru' => 'ru tez',
            ],
            'estimated_time' => [
                'uz' => '1 kun',
                'ru' => 'ru 1 kun',
            ],
            'sum' => 80000
        ]);
    }
}
