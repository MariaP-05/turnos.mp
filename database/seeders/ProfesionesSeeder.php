<?php

namespace Database\Seeders;

use App\Models\Profesion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Profesion::create([
            'denominacion' => 'Medicina'
        ] );

        Profesion::create([
            'denominacion' => 'Kinesiología'
        ] );

        Profesion::create([
            'denominacion' => 'Terapia Ocupacional'
        ] );
    }
}
