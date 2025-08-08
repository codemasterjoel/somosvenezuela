<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\Genero;

class GeneroSeeder extends Seeder
{
    public function run(): void
    {
        Genero::insert([
            ['nombre' => 'MASCULINO'],
            ['nombre' => 'FEMENINA'],
            ['nombre' => 'OTRO']
        ]);
    }
}
