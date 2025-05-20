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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mading_id')->constrained('madings')->onDelete(null);
            $table->string('action');
            $table->string('document');
            $table->json('image_ids');
            $table->foreignId('user_id')->constrained('users')->onDelete(null);
            $table->timestamps();
        });

        DB::table('histories')->whereNull('image_ids')->update(['image_ids' => json_encode([])]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
