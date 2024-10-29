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
        Schema::create('logo_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('products');
            $table->string('logo_name');
            $table->string('tagline')->nullable();
            $table->string('website')->nullable();
            $table->string('company_address')->nullable();
            $table->text('other_requirements')->nullable();
            $table->string('logotype')->nullable();
            $table->string('reference_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_requirements');
    }
};
