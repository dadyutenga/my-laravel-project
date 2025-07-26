<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('udhamini', function (Blueprint $table) {
            // Add foreign key to watu table
            $table->unsignedBigInteger('watu_id')->after('id');
            $table->foreign('watu_id')->references('id')->on('watu')->onDelete('cascade');
            
            // Remove redundant columns
            $table->dropColumn([
                'first_name',
                'middle_name', 
                'last_name',
                'jinsia',
                'mtaa',
                'simu',
                'email',
                'nida'
            ]);
        });
    }

    public function down()
    {
        Schema::table('udhamini', function (Blueprint $table) {
            $table->dropForeign(['watu_id']);
            $table->dropColumn('watu_id');
            
            // Add back the columns
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('jinsia');
            $table->string('mtaa');
            $table->string('simu');
            $table->string('email');
            $table->string('nida');
        });
    }
};