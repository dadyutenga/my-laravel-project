<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balozi_account_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balozi_id')->constrained('balozi')->onDelete('cascade');
            $table->foreignId('mwenyekiti_id')->constrained('mwenyekiti')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('processed_at')->nullable();
            $table->text('admin_comments')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balozi_account_requests');
    }
};