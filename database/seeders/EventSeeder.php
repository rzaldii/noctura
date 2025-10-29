<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'name' => 'AMU 2025',
                'location' => 'Stadion Universitas Jember',
                'date' => '2025-12-16',
                'description' => 'Konser tahunan yang diadakan oleh Aksi Mesin Universitas Jember',
                'image' => 'event 1.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fortuna Fest 2025',
                'location' => 'Stadion Universitas Jember',
                'date' => '2025-11-21',
                'description' => 'Festival musik yang diadakan oleh Fakultas Teknologi Industri Universitas Jember',
                'image' => 'event 2.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AOM JTI',
                'location' => 'Stadion Universitas Jember',
                'date' => '2025-11-29',
                'description' => 'festival musik yang diadakan oleh Jurusan Teknologi Informasi Politeknik Negeri Jember',
                'image' => 'event 3.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
