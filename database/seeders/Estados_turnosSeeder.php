<?php

namespace Database\Seeders;

use App\Models\EstadoTurno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Estados_turnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        EstadoTurno::create([
            'denominacion' => 'Programado',
            'icono' => 'calendar-plus-fill',
            'color' => 'green'
        ] );

        EstadoTurno::create([
            'denominacion' => 'Cancelado',
            'icono' => 'calendar-x-fill',
            'color' => 'red'
        ] );
        

        EstadoTurno::create([
            'denominacion' => 'Realizado',
            'icono' => 'calendar-check-fill',
            'color' => 'yellow'
        ] );
    }
}
