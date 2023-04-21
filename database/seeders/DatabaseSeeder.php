<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(FacilitiesSeeder::class);
        $this->call(DrugsSeeder::class);
        $this->call(ServicesSeeder::class);
    }
}
