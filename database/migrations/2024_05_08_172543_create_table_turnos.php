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
        Schema::create('turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_paciente')->unsigned()->nullable();
            $table->integer('id_profesional')->unsigned()->nullable();
            $table->integer('id_institucion')->unsigned()->nullable();
            $table->date('fecha')->nullable();
            $table->string('hora_inicio')->nullable();
            $table->string('hora_fin')->nullable();
            $table->string('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
                });

            Schema::table('turnos', function (Blueprint $table) {
                    $table->foreign('id_paciente')->references('id')->on('pacientes')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');  
            });

            Schema::table('turnos', function (Blueprint $table) {
                $table->foreign('id_profesional')->references('id')->on('profesionales')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');  
            });

            Schema::table('turnos', function (Blueprint $table) {
                $table->foreign('id_institucion')->references('id')->on('instituciones')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');  
            });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos');
    }
};
