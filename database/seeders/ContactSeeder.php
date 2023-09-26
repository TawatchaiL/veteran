<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CrmContact;
use App\Models\ThCity;
use App\Models\ThDistrict;
use App\Models\ThSubDistrict;

class ContactSeeder extends Seeder
{
    public function run()
    {
        // Number of fake contacts to generate
        $numberOfContacts = 200;

        for ($i = 1; $i <= $numberOfContacts; $i++) {

            $city = ThCity::inRandomOrder()->first();
            $district = ThDistrict::where('city_id', $city->id)->inRandomOrder()->first();
            $subDistrict = ThSubDistrict::where('district_id', $district->id)->inRandomOrder()->first();
            // Generate random phone numbers
            $phoneno = '0' . mt_rand(200, 999) . '-' . mt_rand(1000, 9999);
            $telhome = '0' . mt_rand(200, 999) . '-' . mt_rand(1000, 9999);
            $workno = '0' . mt_rand(200, 999) . '-' . mt_rand(1000, 9999);

            // Generate a random date within a specific range (e.g., last 5 years)
            $startDate = strtotime('-5 years');
            $endDate = strtotime('now');
            $randomTimestamp = mt_rand($startDate, $endDate);

            // Format the random timestamp as a date
            $randomDate = date('Y-m-d', $randomTimestamp);

            CrmContact::create([
                'hn' => 'HN' . random_int(1000, 9999), // Generate a random health number
                'adddate' => $randomDate, // Set the random date here
                'fname' => 'First Name ' . $i,
                'lname' => 'Last Name ' . $i,
                'homeno' => 'Home Address ' . $i,
                'moo' => random_int(1, 1000), // Generate a random number for "moo"
                'road' => 'Road ' . $i,
                'soi' => 'Soi ' . $i,
                'city_id' => $city->id,
                'district_id' => $district->id,
                'subdistrict_id' => $subDistrict->id,
                'postcode' => random_int(10000, 99999), // Generate a random postcode
                'phoneno' => $phoneno, // Set the random phone numbers here
                'telhome' => $telhome,
                'workno' => $workno,
            ]);
        }
    }
}
