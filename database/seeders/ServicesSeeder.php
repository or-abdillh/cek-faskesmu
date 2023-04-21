<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        for( $i = 1; $i <= 100; $i++ ) {
            Service::create([
                'name' => $faker->unique()->words($nb = 2, $asText = true),
                'facility_id' => rand(1, 20),
                'price' => rand(10000, 100000),
                'description' => $faker->sentence(),
                'unit_type' => $faker->randomElement(['Jam', 'Sesi', 'Hari']),
            ]);
        }
    }
}
