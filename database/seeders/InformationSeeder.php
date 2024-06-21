<?php

namespace Database\Seeders;

use App\Models\InformationModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformationModel::factory()->count(5)->create();
    }
}
