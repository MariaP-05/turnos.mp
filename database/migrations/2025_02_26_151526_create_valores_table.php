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
        Schema::create('valores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor')->nullable();
            $table->string('fecha_desde')->nullable();
            $table->integer('id_practica')->unsigned()->nullable();
            $table->integer('id_obra_social')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('valores', function (Blueprint $table) {
            $table->foreign('id_practica')->references('id')->on('practicas')
                ->onDelete('restrict')
                ->onUpdate('cascade');      
        });

        Schema::table('valores', function (Blueprint $table) {
            $table->foreign('id_obra_social')->references('id')->on('obras_sociales')
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
        Schema::dropIfExists('valores');
    }
};
