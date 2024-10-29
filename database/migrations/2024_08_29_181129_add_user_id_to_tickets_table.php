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
        Schema::table('tickets', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id')->after('id');

            // Add foreign key constraint if necessary
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
                // Drop the foreign key constraint first
                $table->dropForeign(['user_id']);

                // Drop the user_id column
                $table->dropColumn('user_id');
        });
    }
};
