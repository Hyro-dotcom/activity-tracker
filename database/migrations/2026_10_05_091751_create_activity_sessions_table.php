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
        Schema::create('activity_sessions', function (Blueprint $table) {
            $table->id();
            // Deleting a user also deletes their session
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Activities that are part of existing sessions can't be deleted
            $table->foreignId('activity_id')->constrained()->restrictOnDelete();
            $table->date('date');
            // Duration in minutes
            $table->integer('duration');
            // Optional notes allow for individual assessment of activity session
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_sessions');
    }
};
