<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::find(1)->addresses()->create([
            "latitude" => "41.6544774",
            "longitude" => "47.467223",
            "region" => "Toshkent",
            "district" => "Bekobod",
            "street" => "Yangiobod",
            "home" => "12" 
        ]);
        
        User::find(1)->addresses()->create([
            "latitude" => "41.6544774",
            "longitude" => "47.467223",
            "region" => "samarqand",
            "district" => "samarqand",
            "street" => "Bedapoya",
            "home" => "32" 
        ]);
        
    }
}
