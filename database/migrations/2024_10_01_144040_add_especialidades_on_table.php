<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('profesiones' , 'especialidades' );
        Schema::table('profesionales', function ($table) {
            $table->renameColumn('id_profesion', 'id_especialidad');
         });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('especialidades', 'profesiones');
        Schema::table('profesionales', function ($table) {
            $table->renameColumn( 'id_especialidad', 'id_profesion');
        });
        //
    }
};
