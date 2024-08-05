<?php

namespace Database\Seeders;

use App\Models\Obra_social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Obras_socialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Obra_social::create([
            'denominacion' => 'Programa de Atención Médico Integral' ,
            'denominacion_amigable' => 'PAMI' ,
            'cuit' => '30666074013' ,
            'telefono'  => '' ,
            'direccion' => '' 
        ] );

        
        Obra_social::create([
            'denominacion' => 'Instituto Obra Médico Asistencial' ,
            'denominacion_amigable' => 'IOMA' ,
            'cuit' => '30628249527' ,
            'telefono'  => '0221-4295943' ,
            'direccion' => 'Calle 46 nº 886 (Entre 12 y 13) , Ciudad de La Plata' 
        ] );
       

        Obra_social::create([
            'denominacion' => 'Organización de Servicios Directos Empresarios' ,
            'denominacion_amigable' => 'OSDE' ,
            'cuit' => '30546741253' ,
            'telefono'  => ' 0800-222-72583' ,
            'direccion' => 'Av. Leandro N. Alem 1067 - Piso 9, Buenos Aires' 
        ] );
  

    }
}
