<?php

namespace Database\Seeders;

use App\Models\diasSemana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiasSemanasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $dias = [
            ['name' => 'Lunes'],
            ['name' => 'Martes'],
            ['name' => 'Miercoles'],
            ['name' => 'Jueves'],
            ['name' => 'Viernes'],
            ['name' => 'Sabado'],
            ['name' => 'Domingo'],
        ];

        foreach ($dias as $item) {
            diasSemana::firstOrCreate(
                ['nombre' => $item['name']],
            );
        }
    }
}
