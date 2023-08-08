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
        //provincias
        Schema::create('provincias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        //localidades
        Schema::create('localidades', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('denominacion');
            $table->string('cod_postal', 50)->unique();           
            $table->integer('provincia_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('localidades', function (Blueprint $table) {
            $table->foreign('provincia_id')->references('id')->on('provincias')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        //bancos
        Schema::create('bancos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denominacion')->unique();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('contacto');
            $table->string('mailcontacto');
            $table->timestamps();
            $table->softDeletes();
        });

        //clientes
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denominacion')->nullable();
            $table->string('denominacion_amigable')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('cuit')->nullable();
            $table->string('cbu')->nullable();
            $table->integer('id_banco')->unsigned();
            $table->string('direccion')->nullable();
            $table->string('telefono');
            $table->string('telefono_2');
            $table->string('nombre_contacto')->nullable();
            $table->string('mail');
            $table->string('mail_2');
            $table->integer('id_localidad')->unsigned();            
            
            $table->boolean('estado');
            $table->decimal('cuenta_corriente', 15,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::table('clientes', function (Blueprint $table) {
            $table->foreign('id_localidad')->references('id')->on('localidades')
                ->onDelete('restrict')
                ->onUpdate('cascade');     
                
                $table->foreign('id_banco')->references('id')->on('bancos')
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
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('localidades');
        Schema::dropIfExists('bancos');
        Schema::dropIfExists('provincias');
    }
};
