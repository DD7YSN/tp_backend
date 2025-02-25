<?php

namespace Database\Seeders;

use App\Models\Monnie;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MnnieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monnie = [
                'nom_monnie' => 'MAD'
        ];

        Monnie::create($monnie);
        $this->command->info('Default monnie created successfully.');
    }
}
