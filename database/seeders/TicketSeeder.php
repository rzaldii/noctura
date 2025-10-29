<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'event_id' => 1,
                'type' => 'Reguler',
                'price' => 90000,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 1,
                'type' => 'VIP',
                'price' => 150000,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 2,
                'type' => 'Normal',
                'price' => 75000,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
