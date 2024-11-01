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
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('dni')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono_aux')->nullable();
            $table->string('mail')->nullable();
            $table->integer('id_localidad')->unsigned()->nullable();
            $table->integer('id_paciente')->unsigned()->nullable();
            $table->string('relacion')->nullable();
            $table->string('observacion')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('contactos', function (Blueprint $table) {
            $table->foreign('id_localidad')->references('id')->on('localidades')
                ->onDelete('restrict')
                ->onUpdate('cascade');
                $table->foreign('id_paciente')->references('id')->on('pacientes')
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
        Schema::dropIfExists('contactos');
    }
};
