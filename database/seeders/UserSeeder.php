<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        //c'est pour vider le tableau
        User::truncate();

        User::create([
           'role' => 'admin', 
           'first_name' => "Admin",
            'last_name' => "Demo",
            'username' => "admin",
            'email' => "admin@example.com",
            'password' => bcrypt('123456'),

        ]);

        User::create([
           'role' => 'gestionnaire', 
           'first_name' => "Oumy",
            'last_name' => "Mbengue",
            'username' => "nom",
            'email' => "nom@example.com",
            'password' => bcrypt('246800'),

        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
