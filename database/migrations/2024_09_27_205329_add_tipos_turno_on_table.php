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
       
        Schema::create('tipos_turno', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denominacion')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::table('turnos', function (Blueprint $table) {
            $table->integer('id_tipos_turno')->unsigned()->nullable()->after ('id_institucion');
        });
       
        Schema::table('turnos', function (Blueprint $table) {
            $table->foreign('id_tipos_turno')->references('id')->on('tipos_turno')
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
       
        Schema::dropIfExists('tipos_turno');
    
    }
};
