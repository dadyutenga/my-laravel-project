
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->enum('user_type', ['admin', 'mwenyekiti', 'balozi']);
            $table->unsignedBigInteger('user_id');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->timestamp('login_at');
            $table->timestamp('logout_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['user_type', 'user_id']);
            $table->index(['is_active', 'login_at']);
            $table->index('session_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};