<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('madings', function (Blueprint $table) {
            $table->enum('status', [
                'Survey', 'Minta Penawaran', 'Penawaran', 'Tagihan DP', 'Time Schedule', 
                'FPP', 'JSA', 'Surat Jalan', 'BAST', 'Tagihan', 'Pengadaan', 
                'Pengiriman', 'Running', 'RETUR', 'Finish', 'Invoice', 'Lunas', 'Komplain'
            ])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('madings', function (Blueprint $table) {
            $table->enum('status', [
                'Tagihan DP', 'FPP', 'Pengadaan', 'Running', 'RETUR', 'BAST', 
                'Invoice', 'Lunas', 'Time Schedule'
            ])->nullable()->change();
        });
    }
};
