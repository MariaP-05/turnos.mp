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
        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_paciente')->unsigned()->nullable();
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->text('observacion');
            $table->date('fecha')->nullable();
            $table->timestamps();
        });

        Schema::table('historias_clinicas', function (Blueprint $table) {
            $table->foreign('id_paciente')->references('id')->on('pacientes')
                ->onDelete('restrict')
                ->onUpdate('cascade');  
        });

      /*  Schema::table('historias_clinicas', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');  
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historias_clinicas');
    }
};
