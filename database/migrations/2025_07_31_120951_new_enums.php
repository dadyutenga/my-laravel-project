<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewEnums extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            // Modify the status column to include our needed values
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled'])
                  ->default('pending')
                  ->change();
            
            // Add admin_notes column
            $table->text('admin_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            // Remove admin_notes column
            $table->dropColumn('admin_notes');
            
            // Revert status column (adjust based on your original enum values)
            $table->enum('status', ['pending', 'completed', 'cancelled'])
                  ->default('pending')
                  ->change();
        });
    }
}
