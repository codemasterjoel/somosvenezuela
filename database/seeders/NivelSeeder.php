<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nivel;

class NivelSeeder extends Seeder
{
    public function run(): void
    {
        Nivel::insert([
            ['nombre' => 'Nacional'], 
            ['nombre' => 'Regional'],
            ['nombre' => 'Municipal'],
            ['nombre' => 'Parroquial'],
            ['nombre' => 'UBCH'],
            ['nombre' => 'Comunidad'],
            ['nombre' => 'Calle']
        ]);
    }
}
