<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::create([
            'name' => [
                'uz' => 'Til',
                'ru' => 'язык'
            ],
            'type' => 'select',
        ]);

        $setting->values()->create([
            'name' => [
                'uz' => 'Uzbekcha',
                'ru' => 'Узбекский'
            ]
        ]);

        $setting->values()->create([
            'name' => [
                'uz' => 'Ruscha',
                'ru' => 'Русский'
            ]
        ]);


        
        $setting = Setting::create([
            'name' => [
                'uz' => 'pul birligi',
                'ru' => 'валюта'
            ],
            'type' => 'select',
        ]);

        $setting->values()->create([
            'name' => [
                'uz' => 'So\'m',
                'ru' => 'сум'
            ]
        ]);

        $setting->values()->create([
            'name' => [
                'uz' => 'dollar',
                'ru' => 'доллар'
            ]
        ]);



        $setting = Setting::create([
            'name' => [
                'uz' => 'Tungi rejim',
                'ru' => 'Темный режим'
            ],
            'type' => 'switch',
        ]);



        $setting = Setting::create([
            'name' => [
                'uz' => 'Xabarnomalar',
                'ru' => 'Уведомления'
            ],
            'type' => 'switch',
        ]);
    }
}
