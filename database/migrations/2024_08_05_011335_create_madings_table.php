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
        Schema::create('madings', function (Blueprint $table) {
            $table->id();
            $table->string('project_owner')->nullable();
            $table->string('work_location')->nullable();
            $table->text('type_of_work')->nullable();
            $table->enum('status', ['Tagihan DP', 'FPP', 'Pengadaan', 'Running', 'RETUR', 'BAST', 'Invoice', 'Lunas', 'Time Schedule'])->nullable();
            $table->date('tanggal')->nullable();
            $table->string('pic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('madings');
    }
};
