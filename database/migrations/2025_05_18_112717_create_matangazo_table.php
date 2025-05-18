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
        Schema::create('matangazo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mtaa_meeting_id')->nullable()->comment('Associated meeting ID, if any');
            $table->unsignedBigInteger('created_by')->comment('Mwenyekiti who created the announcement');
            $table->string('title', 255)->comment('Title of the announcement');
            $table->string('title_sw', 255)->comment('Title in Swahili');
            $table->text('content')->comment('Content of the announcement');
            $table->date('announcement_date')->comment('Date of the announcement');
            $table->string('mtaa', 255)->comment('Target mtaa for the announcement');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->comment('Announcement status');
            $table->timestamps();

            // Foreign keys
            $table->foreign('mtaa_meeting_id')->references('id')->on('mtaa_meetings')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('mwenyekiti')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matangazo');
    }
};