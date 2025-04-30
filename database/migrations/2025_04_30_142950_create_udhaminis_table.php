<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('udhamini', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->string('jinsia', 255);
            $table->string('mtaa', 255);
            $table->string('simu', 255);
            $table->string('email', 255)->nullable();
            $table->string('nida', 255);
            $table->text('sababu');
            $table->text('muelekeo');
            $table->date('tarehe');
            $table->longText('picha')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('mwenyekiti')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('udhamini');
    }
};