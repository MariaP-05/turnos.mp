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
            'color' => 'green',
            'color_class'=> 'success',
            'color_clarito'=> '#ADD8E6'
        ] );

        EstadoTurno::create([
            'denominacion' => 'Cancelado',
            'icono' => 'calendar-x-fill',
            'color' => 'red',
            'color_class'=> 'danger',
            'color_clarito'=> '#FFCCCB'
        ] );
        

        EstadoTurno::create([
            'denominacion' => 'Realizado',
            'icono' => 'calendar-check-fill',
            'color' => 'Blue',
            'color_class'=> 'primary',
            'color_clarito'=> '#90EE90'
        ] );
    }
}
