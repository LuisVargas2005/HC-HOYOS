<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    public function run()
    {
        ShippingMethod::insert([
            [
                'name' => 'Envío estándar (3-5 días)',
                'base_rate' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Envío exprés (1-2 días)',
                'base_rate' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Retiro en tienda',
                'base_rate' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}