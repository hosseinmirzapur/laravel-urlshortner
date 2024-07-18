<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // generate a unique user with profile
        $user = User::query()->create([
            'username' => 'hossein',
            'password' => Hash::make('12345678'),
        ]);

        $user->profile()->create([
            'fullname' => 'hossein mirzapur'
        ]);

        echo $user->createToken($user->username)->plainTextToken;
    }
}
