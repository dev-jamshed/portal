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
        Schema::create('avoid_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('query_id')->constrained()->onDelete('cascade');
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->string('OldQuerystatus')->default('pending'); // pending, accepted, rejected
            $table->foreignId('accepted_by')->nullable()->constrained('users')->onDelete('set null'); // Updated here
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avoid_requests');
    }
};
