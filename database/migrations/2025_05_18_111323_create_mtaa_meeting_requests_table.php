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
        Schema::create('mtaa_meeting_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('balozi_id')->comment('Balozi who created the request');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Request status');
            $table->text('request_details')->nullable()->comment('Details or reason for the request');
            $table->timestamp('requested_at')->useCurrent()->comment('When the request was made');
            $table->timestamp('processed_at')->nullable()->comment('When the request was processed');
            $table->text('admin_comments')->nullable()->comment('Comments from admin on approval/rejection');
            $table->timestamps();

            // Foreign keys
           
            $table->foreign('balozi_id')->references('id')->on('balozi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mtaa_meeting_requests');
    }
};