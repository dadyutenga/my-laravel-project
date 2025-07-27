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
        Schema::create('matangazo_ya_kawaida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); // Mwenyekiti who created the announcement
            $table->string('title'); // Title in English
            $table->string('title_sw'); // Title in Kiswahili
            $table->text('content'); // Main announcement content
            $table->text('content_sw')->nullable(); // Content in Kiswahili (optional)
            $table->date('announcement_date'); // When the announcement is made
            $table->date('effective_date')->nullable(); // When the announcement takes effect
            $table->date('expiry_date')->nullable(); // When the announcement expires
            $table->string('category')->default('general'); // general, emergency, event, notice, etc.
            $table->string('priority')->default('normal'); // low, normal, high, urgent
            $table->string('target_audience')->default('all'); // all, balozi, residents, specific_group
            $table->string('mtaa'); // Which mtaa this applies to
            $table->string('status')->default('active'); // active, inactive, expired, draft
            $table->boolean('is_featured')->default(false); // Featured announcements
            $table->boolean('send_notification')->default(true); // Whether to send notifications
            $table->json('attachments')->nullable(); // File attachments (images, PDFs, etc.)
            $table->integer('views_count')->default(0); // Track how many people viewed
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('created_by')->references('id')->on('mwenyekiti')->onDelete('cascade');
            
            // Indexes for better performance
            $table->index(['status', 'announcement_date']);
            $table->index(['category', 'priority']);
            $table->index(['mtaa', 'status']);
            $table->index('effective_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matangazo_ya_kawaida');
    }
};
