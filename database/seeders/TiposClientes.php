<?php

namespace Database\Seeders;

use App\Models\TipoCliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposClientes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoCliente::create([
            'denominacion' => 'Cuenta Corriente',
            'codigo' => '00'
        ] );

        TipoCliente::create( [
            'denominacion' => 'Caja de Ahorros',
            'codigo' => '01'
        ] );

        TipoCliente::create( [
            'denominacion' => 'Judiciales',
            'codigo' => '66'
        ]);
       
    }
}
