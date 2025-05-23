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
        Schema::table('mahitaji_maalumu', function (Blueprint $table) {
            $table->string('disability_type')->nullable()->after('nida_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahitaji_maalumu', function (Blueprint $table) {
            $table->dropColumn('disability_type');
        });
    }
};