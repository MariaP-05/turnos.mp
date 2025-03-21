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
        //
        Schema::table('obras_sociales', function (Blueprint $table) {
            $table->integer('fecha_presentacion_desde')->nullable()->after('direccion');
            $table->integer('fecha_presentacion_hasta')->nullable()->after('fecha_presentacion_desde');
            $table->string('periodo_informe')->nullable()->after('fecha_presentacion_hasta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('obras_sociales', function (Blueprint $table) {
            $table->dropColumn('fecha_presentacion_desde');
            $table->dropColumn('fecha_presentacion_hasta');
            $table->dropColumn('periodo_informe');
        });
    }
};
