<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::create([
            "name"=> [
                'uz' => 'naqd',
                'ru' => 'ru naqd'
            ],
        ]);
        
        PaymentType::create([
            "name"=> [
                'uz' => 'terminal',
                'ru' => 'ru terminal'
            ],
        ]);
        
        PaymentType::create([
            "name"=> [
                'uz' => 'Payme',
                'ru' => 'ru Payme'
            ],
        ]);
        
        PaymentType::create([
            "name"=> [
                'uz' => 'Click',
                'ru' => 'ru Click'
            ],
        ]);
        
        PaymentType::create([
            "name"=> [
                'uz' => 'Uzum',
                'ru' => 'ru Uzum'
            ],
        ]);
    }
}
