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

class ModerateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_moderateur = Role::where('nom_role', 'moderateur')->first();
        $moderateur = [
            'nom' => 'moderateur',
            'cin' => 'JC123456',
            'telephone' => '0123456789',
            'email' => 'moderateur@gmail.com',
            'password' => Hash::make('moderateur@gmail.com'),
            'local' => 1,
            'adresse' => 'default adresse',
            'numero_compte' => '1234567890',
            'id_role' => $role_moderateur->id,
            'status' => 1,
            'active' => 1,
        ];

        Utilisateur::create($moderateur);
        $this->command->info('Default moderateur and villes created successfully.');
    }
}
