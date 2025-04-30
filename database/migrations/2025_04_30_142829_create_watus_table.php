<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->string('email', 255)->nullable()->unique();
            $table->string('phone_number', 255)->unique();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('marital_status', 255);
            $table->string('occupation', 255);
            $table->string('education_level', 255)->nullable();
            $table->string('income_range', 255)->nullable();
            $table->string('health_status', 255)->nullable();
            $table->string('nida_number', 255)->nullable();
            $table->string('house_no', 255);
            $table->string('mtaa', 255);
            $table->string('region', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('ward', 255)->nullable();
            $table->unsignedBigInteger('balozi_id');
            $table->integer('household_count')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->boolean('is_active')->default(1);
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();

            $table->foreign('balozi_id')->references('id')->on('balozi')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('balozi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watu');
    }
};