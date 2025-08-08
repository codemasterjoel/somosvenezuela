<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            EstadoSeeder::class,
            MunicipioSeeder::class,
            ParroquiaSeeder::class,
            ComunaSeeder::class,
            NivelSeeder::class,
            NivelAcademicoSeeder::class,
            ProfesionSeeder::class,
            ResponsabilidadSeeder::class,
            GeneroSeeder::class,
        ]);
    }
}
