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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('invoice_number')->nullable();
            $table->text('description');
            // $table->dateTime('date_time');
            $table->unsignedBigInteger('user_id'); // No `after` method here
            $table->string('category');
            $table->enum('status', ['Active', 'Pending' ,'Process' , 'Avoid', 'Cancel','Complete','Avoid (pending)'])->default('Active');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('assigned_to')->nullable();
            // $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
