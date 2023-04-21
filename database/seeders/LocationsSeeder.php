<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $provinces = ['Kalimantan Selatan'];
        $cities = [
            'Banjarmasin', 'Banjarbaru', 'Marabahan', 'Balangan', 'Hulu Sungai Utara'
        ];

        foreach($provinces as $province) {
            foreach($cities as $city) {

                Location::create([
                    'city' => $city,
                    'province' => $province
                ]);
            }
        }
    }
}
