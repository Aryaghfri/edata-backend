<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::table('kegiatan', function (Blueprint $table) {
        // Drop FK
        $table->dropForeign('kegiatan_idskpd_foreign');

        // Drop column
        $table->dropColumn('idSKPD');
    });
}

public function down()
{
    Schema::table('kegiatan', function (Blueprint $table) {
        $table->unsignedBigInteger('idSKPD')->after('idPegawai');
        $table->foreign('idSKPD')->references('idSKPD')->on('skpd');
    });
}
};

