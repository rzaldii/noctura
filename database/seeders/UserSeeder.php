<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('userr')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'iqbal',
                'email' => 'iqbal@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sava',
                'email' => 'sava@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'rafa',
                'email' => 'rafa@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
