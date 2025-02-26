<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'nom_status' => 'attender ramassage',
                'color' => 'warning',
            ],
            [
                'nom_status' => 'en cours',
                'color' => '',
            ],
            [
                'nom_status' => 'livre',
                'color' => 'success',
            ],
            [
                'nom_status' => 'refuse',
                'color' => 'danger',
            ],
            [
                'nom_status' => 'mise en distribution',
                'color' => 'secondary',
            ],
        ];

        // Insert statuses into the database
        foreach ($statuses as $status) {
            Status::create($status);
        }

        $this->command->info('Default statuses created successfully.');
    }
}
