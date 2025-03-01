<?php

namespace Database\Seeders;

use App\Models\General;
use App\Models\Status;
use App\Models\Ville;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $data = [
                'nom' => 'App Livraison',
                'id_monnie' => 1,
                'telephone_a' => '1234567890',
                'telephone_b' => '0987654321',
                'fix' => '0123456789',
                'email' => 'support@gmail.com',
                'zone_principal' => 1,
                'adresse' => 'Adresse casa ...',
            ];
            
            General::create($data);

        $this->command->info('Default General created successfully.');
    }
}
