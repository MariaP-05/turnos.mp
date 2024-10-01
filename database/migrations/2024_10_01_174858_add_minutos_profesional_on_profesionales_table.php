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
        //hora inicio y fin laboral
        Schema::table('profesionales', function (Blueprint $table) {
            $table->string('hora_inicio')->nullable()->after('telefono');
            $table->string('hora_fin')->nullable()->after('hora_inicio');
            $table->string('minutos_hab')->nullable()->after('hora_fin');
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profesionales', function (Blueprint $table) {
            $table->dropColumn('hora_inicio');
            $table->dropColumn('hora_fin');
            $table->dropColumn('minutos_hab');
        });
    }
};
