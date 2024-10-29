<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAndUpdateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the table with the specified columns
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); // Primary key column
            $table->string('user_ip', 45)->nullable(); // user_ip column
            $table->foreignId('uid')->constrained('users')->onDelete('cascade'); // Foreign key column
            $table->time('in_time')->nullable(); // in_time column
            $table->time('out_time')->nullable(); // out_time column
            $table->time('total_work_time')->nullable(); // total_work_time column
            $table->enum('check_in_status', ['late', 'on_time']); // check_in_status column
            $table->enum('check_out_status', ['on_time', 'early_out'])->nullable(); // check_out_status column
            $table->date('date')->default(date("Y-m-d")); // date column
            $table->timestamps(); // created_at and updated_at columns
            $table->enum('attendance_status', ['present', 'half_day', 'absent', 'holiday'])->default('absent'); // attendance_status column
        });

        // If you need to apply updates to an existing table, add them here
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the table if it exists
        Schema::dropIfExists('attendances');
    }
}
