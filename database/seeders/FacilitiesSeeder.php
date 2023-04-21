<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 20; $i++) {
            Facility::create(
                [
                    'name' => $faker->company(),
                    'user_id' => rand(1,20),
                    'location_id' => rand(1,5),
                    'category' => $faker->randomElement(['Rumah Sakit', 'Apotek', 'Klinik', 'Praktek']),
                    'description' => $faker->sentence(),
                    'address' => $faker->address(),
                    'phone_number' => $faker->phoneNumber(),
                    'website' => $faker->url(),
                    'longitude' => $faker->longitude($min = 106, $max = 110),
                    'latitude' => $faker->latitude($min = -6, $max = -2)
                ]
            );
        }

    }
}
