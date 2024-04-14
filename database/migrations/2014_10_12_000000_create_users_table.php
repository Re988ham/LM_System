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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile_number');
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            //$table->integer('code')->nullable();
            $table->string('google_id')->nullable();
            $table->integer('country_id')->constrained('countries')->cascadeOnUpdate()->cascadeOnDelete();;
            $table->integer('role_id')->constrained('roles')->cascadeOnUpdate()->cascadeOnDelete();;
            $table->rememberToken();
            $table->timestamps();
            // $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
