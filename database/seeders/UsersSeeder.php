<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Create provider user
        for ($i = 0; $i < 100; $i++) {
            $provider = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('12345678'),
            ]);
            $providerRole = Role::findByName('provider');
            $provider->assignRole($providerRole);
        }

        // Create regular users
        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('12345678'),
            ]);
            $userRole = Role::findByName('user');
            $user->assignRole($userRole);
        }
    }
}
