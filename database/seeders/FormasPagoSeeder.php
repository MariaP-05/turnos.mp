<?php

namespace Database\Seeders;

use App\Models\Forma_Pago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormasPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Forma_Pago::create([
            'denominacion' => 'Cupones'
        ] );

        Forma_Pago::create([
            'denominacion' => 'Debito Tarjeta'
        ] );

        Forma_Pago::create([
            'denominacion' => 'Debito CBU'
        ] );
       
    }
}
