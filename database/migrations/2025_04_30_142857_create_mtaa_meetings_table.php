<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mtaa_meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('title_sw', 255);
            $table->text('agenda');
            $table->date('meeting_date');
            $table->string('mtaa', 255);
            $table->unsignedBigInteger('organizer_id');
            $table->text('outcome')->nullable();
            $table->timestamps();

            $table->foreign('organizer_id')->references('id')->on('mwenyekiti')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mtaa_meetings');
    }
};