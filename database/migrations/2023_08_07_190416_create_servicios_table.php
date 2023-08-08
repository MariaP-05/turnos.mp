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
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('servicios_valor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_servicio')->unsigned()->nullable();
            $table->date('fecha')->nullable();    
            $table->decimal('valor', 15,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('servicios_valor', function (Blueprint $table) {
            $table->foreign('id_servicio')->references('id')->on('servicios')
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
        Schema::dropIfExists('servicios_valor');
        Schema::dropIfExists('servicios');
    }
};
