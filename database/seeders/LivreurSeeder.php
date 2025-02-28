<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Zone;
use App\Models\Ville;
use App\Models\Status;
use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LivreurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_livreur = Role::where('nom_role', 'livreur')->first();
        $livreur = [
            'nom' => 'livreur',
            'cin' => 'JC123456',
            'telephone' => '0123456789',
            'email' => 'livreur@gmail.com',
            'password' => Hash::make('livreur@gmail.com'),
            'local' => 1,
            'adresse' => 'default adresse',
            'numero_compte' => '1234567890',
            'id_role' => $role_livreur->id,
            'status' => 1,
            'active' => 1,
        ];

        Utilisateur::create($livreur);
        $this->command->info('Default livreur and villes created successfully.');
    }
}
