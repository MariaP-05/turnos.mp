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
         
        Schema::create('profesionales_afines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('mail')->nullable();           
            $table->string('matricula')->nullable();          
            $table->integer('id_especialidad')->unsigned()->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('profesionales_afines', function (Blueprint $table) {
            $table->foreign('id_especialidad')->references('id')->on('especialidades')
                ->onDelete('restrict')
                ->onUpdate('cascade') ;      
        });

        Schema::create('pacientes_profesionales_afines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_paciente')->unsigned()->nullable();
            $table->integer('id_profesional_afin')->unsigned()->nullable();
            $table->date('fecha_desde')->nullable();
            $table->date('fecha_hasta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pacientes_profesionales_afines', function (Blueprint $table) {
            $table->foreign('id_paciente')->references('id')->on('pacientes')
                ->onDelete('restrict')
                ->onUpdate('cascade'); 

                $table->foreign('id_profesional_afin')->references('id')->on('profesionales_afines')
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
        Schema::dropIfExists('pacientes_profesionales_afines');
        Schema::dropIfExists('profesionales_afines');
         
    }
};
