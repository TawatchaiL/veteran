<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasesTableSeeder extends Seeder
{
    public function run()
    {
        // Simulate data and insert into the 'cases' table
        $dataToInsert = [];

        for ($i = 1; $i <= 100; $i++) {
            $phoneNumber = '0' . mt_rand(8, 9) . str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT); // Generate Thai mobile number
            $dataToInsert[] = [
                'created_at' => now()->subDays(rand(1, 365))->format('Y-m-d H:i:s'), // Random date within the last year
                'telno' => $phoneNumber,
                'agent' => 'Agent ' . $i, // Example agent name
            ];
        }

        // Insert the simulated data into the 'cases' table
        DB::table('cases')->insert($dataToInsert);
    }
}
