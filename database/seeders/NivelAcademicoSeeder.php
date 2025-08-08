<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\NivelAcademico;

class NivelAcademicoSeeder extends Seeder
{
    public function run(): void
    {
        NivelAcademico::insert([
            ['nombre' => 'SIN ESTUDIOS'],
            ['nombre' => 'PRIMARIA'],
            ['nombre' => 'BACHILLERATO'],
            ['nombre' => 'TÉCNICO MEDIO'],
            ['nombre' => 'TECNICO SUPERIOR UNIVERSITARIO'],
            ['nombre' => 'UNIVERSITARIO'],
            ['nombre' => 'ESPECIALIZACIÓN'],
            ['nombre' => 'POSTGRADO'],
            ['nombre' => 'DOCTORADO']
        ]);
    }
}
