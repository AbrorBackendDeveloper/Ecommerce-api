<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => [
                'uz' => 'Yangi',
                'ru' => 'ru yangi',
            ],
            'code' => 'new',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'tasdiqlandi',
                'ru' => 'ru tasdiqlandi',
            ],
            'code' => 'confirmed',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'ishlanyapti',
                'ru' => 'ru ishlanyapti',
            ],
            'code' => 'processing',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'yetkazilmoqda',
                'ru' => 'ru yetkazilmoqda',
            ],
            'code' => 'shipping',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'yetkazildi',
                'ru' => 'ru yetkazildi',
            ],
            'code' => 'delivered',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'tugatildi',
                'ru' => 'ru tugatildi',
            ],
            'code' => 'completed',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'yopildi',
                'ru' => 'ru yopildi',
            ],
            'code' => 'closed',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'to\'lov kutilmoqda',
                'ru' => 'ru tolov kutilmoqda',
            ],
            'code' => 'waiting for payment',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'to\'landi',
                'ru' => 'to\'landi',
            ],
            'code' => 'paid',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'bekor qilindi',
                'ru' => 'ru bekor qilindi',
            ],
            'code' => 'canseled',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'qaytarib berildi',
                'ru' => 'ru qaytarib berildi',
            ],
            'code' => 'refunded',
            'for' => 'order'
        ]);
        
        Status::create([
            'name' => [
                'uz' => 'to\'lovda xatolik',
                'ru' => 'ru to\'lovda xatolik',
            ],
            'code' => 'payment_error',
            'for' => 'order'
        ]);
        
    }
}
