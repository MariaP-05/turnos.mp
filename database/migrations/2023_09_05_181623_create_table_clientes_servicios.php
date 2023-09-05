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
        Schema::create('clientes_servicios', function (Blueprint $table) {
            $table->increments('id');  
            $table->integer('id_cliente')->unsigned()->nullable();      
            $table->integer('id_servicio')->unsigned()->nullable();
            $table->date('fecha_desde')->nullable();    
            $table->date('fecha_hasta')->nullable(); 
            $table->text('observaciones')->nullable();   
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_servicios');
    }
};
