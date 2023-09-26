<?php

/* namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory; */

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
/* class ContactFactory extends Factory
{ */
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   /*  public function definition(): array
    {
        return [
            //
        ];
    }
} */

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'hn' => $faker->unique()->ean8,
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'homeno' => $faker->buildingNumber,
        'moo' => $faker->randomNumber(3),
        'road' => $faker->streetName,
        'soi' => $faker->streetSuffix,
        'city' => $faker->city,
        'district' => $faker->state,
        'subdistrict' => $faker->word,
        'postcode' => $faker->postcode,
        'phoneno' => $faker->phoneNumber,
        'telhome' => $faker->phoneNumber,
        'workno' => $faker->phoneNumber,
    ];
});
