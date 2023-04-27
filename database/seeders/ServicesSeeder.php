<?php

namespace Database\Seeders;

use App\Models\Facility;
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

        $services = [
            'Pemeriksaan Umum',
            'Pemeriksaan Gigi',
            'Tes Darah',
            'USG',
            'Fisioterapi',
            'Operasi Bedah',
            'Terapi Psikologi',
            'Konsultasi Gizi',
            'Rehabilitasi Medis',
            'Pemeriksaan Mata',
            'Konsultasi Kebidanan',
            'Pemeriksaan Laboratorium',
            'Radiologi',
            'Konseling Kesehatan',
            'Vaksinasi',
        ];

        $facilities = Facility::all();

        foreach($facilities as $facility) {
            foreach($services as $service) {

                Service::create([
                    'name' => $service,
                    'facility_id' => $facility->id,
                    'price' => rand(50000, 1000000),
                    'description' => $faker->paragraph(6),
                    'unit_type' => $faker->randomElement(['Jam', 'Sesi', 'Hari']),
                ]);
            }
        }
    }
}
