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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('specialization_id')->constrained('specializations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('description');
            $table->enum('status', ['pending', 'accepted']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};