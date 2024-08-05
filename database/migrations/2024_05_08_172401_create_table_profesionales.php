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
        Schema::create('profesionales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('cuit')->nullable();
            $table->string('telefono')->nullable();
            $table->string('mail')->nullable();
            $table->integer('id_profesion')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('profesionales', function (Blueprint $table) {
            $table->foreign('id_profesion')->references('id')->on('profesiones')
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
        Schema::dropIfExists('profesionales');
    }
};
