<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;


class ContactFactory extends Factory
{
    protected $model = \App\Models\Contact::class;

    public function definition()
    {
        return [
            'hn' => 'HN' . $this->faker->unique()->numberBetween(1000, 9999), // Unique health number
            'fname' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'homeno' => $this->faker->buildingNumber,
            'moo' => $this->faker->randomNumber(3),
            'road' => $this->faker->streetName,
            'soi' => $this->faker->streetSuffix,
            'city' => $this->faker->city,
            'district' => $this->faker->state,
            'subdistrict' => $this->faker->word,
            'postcode' => $this->faker->postcode,
            'phoneno' => $this->faker->phoneNumber,
            'telhome' => $this->faker->phoneNumber,
            'workno' => $this->faker->phoneNumber,
        ];
    }
}
