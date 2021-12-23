<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'site_name'        => 'Edoardo',
            'site_email'       => 'admin@admin.com',
            'site_title'       => 'Multipurpose Livewire',
            'footer_text'      => 'Copyright © 2014-2021 Edisys. All rights reserved.',
            'sidebar_collapse' => false,
        ]);

        \App\Models\User::create([
            'name'              => "Admin Istrator",
            'email'             => "admin@admin.com",
            'email_verified_at' => now(),
            'created_at'        => now(),
            'password'          => Hash::make('admin'), // password = admin
            'remember_token'    => Str::random(10),
            'role'              => 'admin',
        ]);

         \App\Models\User::factory(12)->create();
         \App\Models\Client::factory(8)->create();

    }
}
