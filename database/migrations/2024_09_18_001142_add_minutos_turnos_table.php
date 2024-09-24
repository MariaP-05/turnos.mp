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
        //'minuto_inicio', 'minuto_fin'
        Schema::table('turnos', function (Blueprint $table) {
            $table->string('minuto_inicio')->nullable()->after('hora_inicio');
            $table->string('minuto_fin')->nullable()->after('hora_fin');
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
    }
};
