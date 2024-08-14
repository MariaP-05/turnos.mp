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
        /*
        Schema::create('estados_turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denominacion')->nullable();
            $table->string('icono')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

 */
        Schema::table('turnos', function (Blueprint $table) {
            $table->integer('id_estado_turnos')->unsigned()->nullable()->after ('id_institucion');
        });
       
        Schema::table('turnos', function (Blueprint $table) {
            $table->foreign('id_estado_turnos')->references('id')->on('estados_turnos')
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
       
        Schema::dropIfExists('estados_turnos');
    
    }
};
