<?php

namespace Database\Seeders;

use App\Models\EstadoTurno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Estados_turnosSeederUpdate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     

        $turno = EstadoTurno::where('id',3)->first();
        $turno->color = 'gray';
        $turno->color_class = 'secondary';
        $turno->color_clarito = '#cfcccc';
        $turno->save();
    }
}
