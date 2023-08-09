<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\level;
class levelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        level::create([
            'name' => 'K1',
            'status' => 1
        ]);
        level::create([
            'name' => 'K2',
            'status' => 1
        ]);
        level::create([
            'name' => 'P1',
            'status' => 1
        ]);
        level::create([
            'name' => 'P2',
            'status' => 1
        ]);
        level::create([
            'name' => 'P3',
            'status' => 1
        ]);
        level::create([
            'name' => 'P4',
            'status' => 1
        ]);
        level::create([
            'name' => 'P5',
            'status' => 1
        ]);
        level::create([
            'name' => 'P6',
            'status' => 1
        ]);
    }
}
