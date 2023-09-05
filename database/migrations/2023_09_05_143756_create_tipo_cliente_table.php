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
        Schema::create('tipos_cliente', function (Blueprint $table) {
            $table->increments('id');  
            $table->string('denominacion')->nullable();
            $table->string('codigo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('clientes',  function (Blueprint $table) {
            $table->integer('id_tipo_cliente')->unsigned()->nullable()->after('cuit');
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->foreign('id_tipo_cliente')->references('id')->on('tipos_cliente')
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
        Schema::dropIfExists('tipo_cliente');
    }
};
