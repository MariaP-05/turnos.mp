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
        Schema::create('sesiones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_paciente')->unsigned()->nullable();
            $table->integer('id_profesional')->unsigned()->nullable();
            $table->integer('cantidad_recetada')->nullable();
            $table->integer('cantidad_turnos_reales')->nullable();
            $table->integer('cantidad_turnos_realizados')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('sesiones', function (Blueprint $table) {
            $table->foreign('id_paciente')->references('id')->on('pacientes')
                ->onDelete('restrict')
                ->onUpdate('cascade');  
    });

    Schema::table('sesiones', function (Blueprint $table) {
        $table->foreign('id_profesional')->references('id')->on('profesionales')
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
        Schema::dropIfExists('sesiones');
    }
};
