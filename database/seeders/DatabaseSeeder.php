<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'nis' => '-',
            'rombel' => '-',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminp5'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'nis' => '-',
            'rombel' => '-',
            'email' => 'user@gmail.com',
            'password' => bcrypt('userp5'),
            'role' => 'user',
           ]);
    }
}
