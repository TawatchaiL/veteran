<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\discontinued_reason;

class discontinuedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        discontinued_reason::create([
            'name' => 'Bored',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Dislike Homework',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Dislike Teaching Mode',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Dislike Class Environment',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Home Tution',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Missing in Action',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'No Time',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'No Result',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Relocation',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Special Needs Child',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Too Expensive',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Too Difficult',
            'status' => 1
        ]);
        discontinued_reason::create([
            'name' => 'Others',
            'status' => 1
        ]);

    }
}
