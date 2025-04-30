<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balozi_auths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('balozi_id')->unique();
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('balozi_id')->references('id')->on('balozi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balozi_auths');
    }
};