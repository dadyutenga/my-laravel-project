<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaya_maskini', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->string('gender', 255);
            $table->string('street', 255);
            $table->string('phone', 255);
            $table->text('description')->nullable();
            $table->integer('household_count');
            $table->text('household_members')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('balozi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaya_maskini');
    }
};