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
                'nom_status' => 'livré',
                'color' => 'success',
            ],
            [
                'nom_status' => 'refusé',
                'color' => 'danger',
            ],
            [
                'nom_status' => 'mise en distribution',
                'color' => 'secondary',
            ],
            [
                'nom_status' => 'reporté',
                'color' => 'primary', 
            ],
            [
                'nom_status' => 'pas de réponse',
                'color' => 'warning', 
            ],
            [
                'nom_status' => 'annulé',
                'color' => 'danger'
            ],
            [
                'nom_status' => 'hors-zone',
                'color' => 'dark', 
            ],
            [
                'nom_status' => 'boîte vocale',
                'color' => 'info',
            ],
            [
                'nom_status' => 'en voyage',
                'color' => 'secondary', 
            ],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }

        $this->command->info('Default statuses created successfully.');
    }
}
