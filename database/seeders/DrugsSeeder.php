<?php

namespace Database\Seeders;

use App\Models\Drug;
use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DrugsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        $drugs = [
            'Paracetamol',
            'Amoxicillin',
            'Ibuprofen',
            'Lansoprazole',
            'Metformin',
            'Simvastatin',
            'Cetirizine',
            'Omeprazole',
            'Aspirin',
            'Diazepam',
            'Atorvastatin',
            'Glibenclamide',
            'Metronidazole',
            'Prednisone',
            'Ciprofloxacin',
        ];

        $facilities = Facility::all();
        
        foreach($facilities as $facility) {
            foreach($drugs as $drug) {
                Drug::create(
                    [
                        'name' => $drug,
                        'facility_id' => $facility->id,
                        'price' => rand(5000, 100000),
                        'description' => $faker->paragraph(8),
                        'unit_type' => $faker->randomElement(['Kapsul', 'Kaplet', 'Tablet', 'Botol', 'Suntikan', 'Biji']),
                    ]
                );
            }
        }
    }
}
