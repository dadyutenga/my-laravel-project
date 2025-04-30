<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mapendekezo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('maelezo');
            $table->text('maeneo');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('mwenyekiti')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mapendekezo');
    }
};