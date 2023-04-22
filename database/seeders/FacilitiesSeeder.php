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

        for ($i = 1; $i <= 100; $i++) {
            Facility::create(
                [
                    'name' => $faker->unique()->company(),
                    'user_id' => $i,
                    'location_id' => rand(1,5),
                    'category' => $faker->randomElement(['Rumah Sakit', 'Apotek', 'Klinik', 'Praktek']),
                    'description' => $faker->paragraph(5),
                    'address' => $faker->address(),
                    'phone_number' => $faker->phoneNumber(),
                    'website' => $faker->url(),
                    'longitude' => $faker->longitude($min = 114, $max = 116),
                    'latitude' => $faker->latitude($min = -4, $max = -2)
                ]
            );
        }

    }
}
