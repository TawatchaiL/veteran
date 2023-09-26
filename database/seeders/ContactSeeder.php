<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        // Generate 50 fake contact records


     /*    DB::table('contacts')->insert(
            Contact::factory()->count(50)->create()
        ); */


        Contact::factory()->count(50)->create();
    }
}
