<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\bookuse;

class bookuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        bookuse::create([
            'name' => 'G21-G30',
            'status' => 1
        ]);
        bookuse::create([
            'name' => 'G26-G30',
            'status' => 1
        ]);
    }
}
