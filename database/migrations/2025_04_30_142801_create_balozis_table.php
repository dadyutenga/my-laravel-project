<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balozi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mwenyekiti_id');
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->string('email', 255)->nullable()->unique();
            $table->string('phone', 255)->unique();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('national_id', 255)->nullable();
            $table->string('street_village', 255);
            $table->string('shina', 255)->nullable();
            $table->string('shina_number', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();

            $table->foreign('mwenyekiti_id')->references('id')->on('mwenyekiti')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balozi');
    }
};