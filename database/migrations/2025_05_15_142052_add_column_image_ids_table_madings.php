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
            $table->json('image_ids')->nullable();
        });
    
        // Set empty array for existing rows
        DB::table('madings')->whereNull('image_ids')->update(['image_ids' => json_encode([])]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('madings', function (Blueprint $table) {
            $table->dropColumn(['image_ids']);
        });
    }
};
