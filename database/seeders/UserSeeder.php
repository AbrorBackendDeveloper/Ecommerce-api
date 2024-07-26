<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'first_name' => 'Admin2',
            'last_name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'phone' => +998936853665,
            'password' => Hash::make('Progressiya')            
        ]);
        $user->assignRole('admin');
        
        
        $user = User::create([
            'first_name' => 'editor',
            'last_name' => 'Editor',
            'email' => 'editor@gmail.com',
            'phone' => +998936853660,
            'password' => Hash::make('Progressiya')            
        ]);

        $user->assignRole('editor');        
        
        $user = User::create([
            'first_name' => 'Customer',
            'last_name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone' => +998936853669,
            'password' => Hash::make('Progressiya')            
        ]);

        $user->assignRole('customer');  

        
        $user = User::create([
            'first_name' => 'Manager',
            'last_name' => 'Manager',
            'email' => 'manager@gmail.com',
            'phone' => +998933333333,
            'password' => Hash::make('Progressiya')            
        ]);

        $user->assignRole('shop-manager');        

        
        $user = User::create([
            'first_name' => 'Support',
            'last_name' => 'Support',
            'email' => 'support@gmail.com',
            'phone' => +99893333344,
            'password' => Hash::make('Progressiya')            
        ]);

        $user->assignRole('helpdesk-support');        

        
        
        $users = User::factory()->count(10)->create();

        foreach($users as $user){
            $user->assignRole('customer');
        }
    }
}
