<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\term;

class termSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        term::create([
            'name' => '1',
            'status' => 1
        ]);
        term::create([
            'name' => '2',
            'status' => 1
        ]);
        term::create([
            'name' => '3',
            'status' => 1
        ]);
        term::create([
            'name' => '4',
            'status' => 1
        ]);
    }
}
