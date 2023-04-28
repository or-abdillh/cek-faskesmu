<?php

namespace Database\Seeders;

use App\Models\Drug;
use App\Models\Facility;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        $users = User::role('user')->get();
        $facilities = Facility::all();
        $services = Service::all();
        $drugs = Drug::all();

        foreach( $users as $user ) {

            // Review for facilty
            $facilities->each(function($facility) use ($user, $faker) {
                Review::create([
                    'user_id' => $user->id,
                    'reviewable_id' => $facility->id,
                    'reviewable_type' => 'App\Models\Facility',
                    'content' => $faker->sentence(),
                    'rate' => rand(1, 5)
                ]);
            });

            // Review for Drug
            $drugs->each(function ($drug) use ($user, $faker) {
                Review::create([
                    'user_id' => $user->id,
                    'reviewable_id' => $drug->id,
                    'reviewable_type' => 'App\Models\Drug',
                    'content' => $faker->sentence(),
                    'rate' => rand(1, 5)
                ]);
            });

            $services->each(function ($service) use ($user, $faker) {
                Review::create([
                    'user_id' => $user->id,
                    'reviewable_id' => $service->id,
                    'reviewable_type' => 'App\Models\Service',
                    'content' => $faker->sentence(),
                    'rate' => rand(1, 5)
                ]);
            });
        }
    }
}
