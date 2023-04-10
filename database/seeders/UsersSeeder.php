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

        // Create superadmin user
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $superadminRole = Role::findByName('superadmin');
        $superadmin->assignRole($superadminRole);

        // Create provider user
        $provider = User::create([
            'name' => 'Provider',
            'email' => 'provider@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $providerRole = Role::findByName('provider');
        $provider->assignRole($providerRole);

        // Create 20 regular users
        for ($i = 0; $i < 20; $i++) {
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
