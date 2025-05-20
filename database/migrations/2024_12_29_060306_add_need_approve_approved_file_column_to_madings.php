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
            $table->boolean('need_approve')->default(false)->after('pic');
            $table->boolean('approved')->nullable()->after('need_approve');
            $table->string('document')->nullable()->after('approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('madings', function (Blueprint $table) {
            $table->dropColumn('need_approve');
            $table->dropColumn('approved');
            $table->dropColumn('document');
        });
    }
};
