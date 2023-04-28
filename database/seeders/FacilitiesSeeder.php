<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        $facilities = [
            [
                "name" => "RSUD Ulin",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RSUD Abdul Aziz",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RS Antasari",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RS Muhammadiyah Banjarmasin",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RS Anugerah Banjarbaru",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RS Syamsudin Noor",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RSUD Dr. H. Boejasin",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RSUD Ulin Barat",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RSUD Sultan Suriansyah",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RS Delta Banjarmasin",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "RS Jiwa Provinsi Kalsel",
                "category" => "Rumah Sakit"
            ],
            [
                "name" => "Apotek K24",
                "category" => "Apotek"
            ],
            [
                "name" => "Apotek Kimia Farma",
                "category" => "Apotek"
            ],
            [
                "name" => "Apotek K-24 Syamsudin Noor",
                "category" => "Apotek"
            ],
            [
                "name" => "Apotek Guardian",
                "category" => "Apotek"
            ],
            [
                "name" => "Apotek Roxy",
                "category" => "Apotek"
            ],
            [
                "name" => "Klinik Sehat",
                "category" => "Klinik"
            ],
            [
                "name" => "Klinik Pratama Medika",
                "category" => "Klinik"
            ],
            [
                "name" => "Klinik Bina Medika",
                "category" => "Klinik"
            ],
            [
                "name" => "Klinik Sentosa",
                "category" => "Klinik"
            ],
            [
                "name" => "Klinik Medika Prima",
                "category" => "Klinik"
            ],
            [
                "name" => "Praktek Dokter Utama",
                "category" => "Praktek"
            ],
            [
                "name" => "Praktek Dokter Kharisma",
                "category" => "Praktek"
            ],
            [
                "name" => "Praktek Dokter Sejahtera",
                "category" => "Praktek"
            ],
            [
                "name" => "Praktek Dokter Mulya",
                "category" => "Praktek"
            ],
            [
                "name" => "Praktek Dokter Harapan",
                "category" => "Praktek"
            ]
        ];

        $providersUser = Role::findByName('provider')->users;
        $providers = [];

        foreach($providersUser as $user) {
            $providers[] = $user->id;
        }

        foreach($facilities as $index => $facility) {
            Facility::create(
                [
                    'name' => $facility["name"],
                    'user_id' => $providers[$index],
                    'location_id' => rand(1,5),
                    'category' => $facility["category"],
                    'description' => $faker->paragraph(12),
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
