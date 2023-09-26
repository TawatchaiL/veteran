<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        // Number of fake contacts to generate
        $numberOfContacts = 50;

        for ($i = 1; $i <= $numberOfContacts; $i++) {
            Contact::create([
                'hn' => 'HN' . random_int(1000, 9999), // Generate a random health number
                'fname' => 'First Name ' . $i,
                'lname' => 'Last Name ' . $i,
                'homeno' => 'Home Address ' . $i,
                'moo' => random_int(1, 1000), // Generate a random number for "moo"
                'road' => 'Road ' . $i,
                'soi' => 'Soi ' . $i,
                'city' => 'City ' . $i,
                'district' => 'District ' . $i,
                'subdistrict' => 'Subdistrict ' . $i,
                'postcode' => random_int(10000, 99999), // Generate a random postcode
                'phoneno' => 'Phone ' . $i,
                'telhome' => 'Home Phone ' . $i,
                'workno' => 'Work Phone ' . $i,
            ]);
        }
    }
}
