<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin Istrator",
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
            'password' => Hash::make('admin'), // password = admin
            'remember_token' => Str::random(10),
        ]);

         \App\Models\User::factory(12)->create();
         \App\Models\Client::factory(8)->create();
    }
}
