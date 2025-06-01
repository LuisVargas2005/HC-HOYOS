<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            'name' => config('app.name', 'Liberu Real Estate'),
            'currency' => '£',
            'default_language' => 'en',
            'address' => '123 Real Estate St, London, UK',
            'country' => 'United Kingdom',
            'email' => 'info@liberurealestate.com',
        ];

        foreach ($settings as $setting => $value) {
            SiteSetting::updateOrCreate(
                ['name' => $setting],         // condición (única)
                ['value' => $value]           // datos a actualizar o insertar
            );
        }
    }
}