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
        Schema::table('obras_sociales', function (Blueprint $table) {
            $table->text('observacion', 1000)->nullable()->after('cuit');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('obras_sociales', function (Blueprint $table) {
            $table->dropColumn('observacion');
        });
    }
};
