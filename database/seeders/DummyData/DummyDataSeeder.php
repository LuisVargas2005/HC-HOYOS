<?php

namespace Database\Seeders\DummyData;

use Illuminate\Database\Seeder;
use Database\Seeders\DummyData\CarProductCategorySeeder;
use Database\Seeders\DummyData\CarProductSeeder;
use Database\Seeders\DummyData\ProductCollectionSeeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CarProductCategorySeeder::class,
            CarProductSeeder::class,
            ProductCollectionSeeder::class,
        ]);
    }
}