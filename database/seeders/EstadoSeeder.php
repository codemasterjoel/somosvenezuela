<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run(): void
    {
        Estado::insert([
            ['id' => '1', 'nombre' => 'DISTRITO CAPITAL'],
            ['id' => '2', 'nombre' => 'ANZOÁTEGUI'],
            ['id' => '3', 'nombre' => 'APURE'],
            ['id' => '4', 'nombre' => 'ARAGUA'],
            ['id' => '5', 'nombre' => 'BARINAS'],
            ['id' => '6', 'nombre' => 'BOLÍVAR'],
            ['id' => '7', 'nombre' => 'CARABOBO'],
            ['id' => '8', 'nombre' => 'COJEDES'],
            ['id' => '9', 'nombre' => 'FALCÓN'],
            ['id' => '10', 'nombre' => 'GUÁRICO'],
            ['id' => '11', 'nombre' => 'LARA'],
            ['id' => '12', 'nombre' => 'MÉRIDA'],
            ['id' => '13', 'nombre' => 'MIRANDA'],
            ['id' => '14', 'nombre' => 'MONAGAS'],
            ['id' => '15', 'nombre' => 'NUEVA ESPARTA'],
            ['id' => '16', 'nombre' => 'PORTUGUESA'],
            ['id' => '17', 'nombre' => 'SUCRE'],
            ['id' => '18', 'nombre' => 'TÁCHIRA'],
            ['id' => '19', 'nombre' => 'TRUJILLO'],
            ['id' => '20', 'nombre' => 'YARACUY'],
            ['id' => '21', 'nombre' => 'ZULIA'],
            ['id' => '22', 'nombre' => 'AMAZONAS'],
            ['id' => '23', 'nombre' => 'DELTA AMACURO'],
            ['id' => '24', 'nombre' => 'LA GUAIRA'],
            ['id' => '25', 'nombre' => 'GUAYANA ESEQUIBA'],
            ['id' => '26', 'nombre' => 'NACIONAL']
        ]);
    }
}
