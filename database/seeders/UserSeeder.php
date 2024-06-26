<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $passwordHashed = Hash::make('password_not_secure');

        for ($i = 0; $i < 20; $i++) {
            User::factory()->create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $passwordHashed,
            ]);
        }
    }
}
