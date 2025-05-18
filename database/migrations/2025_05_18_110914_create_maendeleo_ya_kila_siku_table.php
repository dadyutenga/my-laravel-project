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
        Schema::create('maendeleo_ya_kila_siku_mwenyekiti', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tarehe')->comment('Date of the development activity');
            $table->text('maelezo')->comment('Description of the development activity');
            $table->text('maoni')->nullable()->comment('Comments or notes');
            $table->unsignedBigInteger('created_by')->comment('Mwenyekiti who created the record');
            $table->timestamps();

            // Foreign key to mwenyekiti table
            $table->foreign('created_by')->references('id')->on('mwenyekiti')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maendeleo_ya_kila_siku_mwenyekiti');
    }
};