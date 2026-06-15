<?php

namespace Database\Seeders;
use App\Models\AnneeScolaire;
use App\Models\Classes;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(\Database\Seeders\RoleSeeder::class);
        $this->call(\Database\Seeders\PermissionSeeder::class);
        // User::factory(10)->create();

        User::factory()->create([
            'matricule' => 'TestMatricule',
            'email' => 'test@example.com',
        ]);

        AnneeScolaire::create([
            'libelle' => '2025-2026',
            'active'  => true,
        ]);
    }
}
