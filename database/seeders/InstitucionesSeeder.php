<?php

namespace Database\Seeders;

use App\Models\Institucion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitucionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Institucion::create([
            'nombre' => 'Instituto de Kinesiología Integral - IKI'
        ] );

        Institucion::create([
            'nombre' => 'Hospital Provincial de Agudos San Felipe'
        ] );

       
    }
}
