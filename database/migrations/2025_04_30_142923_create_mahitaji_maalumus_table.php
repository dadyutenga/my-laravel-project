<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahitaji_maalumu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->integer('age');
            $table->string('gender', 255);
            $table->string('phone', 255);
            $table->string('nida_number', 255);
            $table->string('pdf_file_path', 255)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('balozi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahitaji_maalumu');
    }
};