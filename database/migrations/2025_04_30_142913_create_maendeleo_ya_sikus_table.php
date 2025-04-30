<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maendeleo_ya_siku', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tarehe');
            $table->text('maelezo');
            $table->text('maoni')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('balozi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maendeleo_ya_siku');
    }
};