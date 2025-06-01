<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class DefaultTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::updateOrCreate(
            ['id' => 1], // condición para evitar duplicado de clave primaria
            [
                'name' => 'default',
                'personal_team' => false,
                'user_id' => 1,
            ]
        );
    }
}