<?php

use Illuminate\Database\Seeder;
use App\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i <= 10; $i++) {
            Contact::create([
                'name' => $faker->name,
                'surname' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'birth' => $faker->dateTimeThisCentury->format('d-m-Y'),
            ]);
        }
    }
}
