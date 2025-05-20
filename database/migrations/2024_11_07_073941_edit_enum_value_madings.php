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
        Schema::table('madings', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//         ALTER TABLE n1575633_mading_bisekas.madings 
// MODIFY COLUMN status enum('Tagihan DP', 'FPP', 'Pengadaan', 'Running', 'RETUR', 'Finish', 'Invoice', 'Lunas', 'Time Schedule');

        Schema::table('madings', function (Blueprint $table) {
            $table->enum('status', ['Tagihan DP', 'FPP', 'Pengadaan', 'Running', 'RETUR', 'Finish', 'Invoice', 'Lunas', 'Time Schedule'])->nullable()->change();
        });
    }
};
