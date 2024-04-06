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
<<<<<<< HEAD
            $table->string('country');
            $table->string('specialization');
            $table->string('mobile_number');
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->integer('code');
=======
            $table->string('address')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birth_date')->nullable();
            //$table->integer('code');
>>>>>>> ed1f74a1f0c876f204dcb737ef14993d567efc72
            $table->foreignId('role_id')->default(3);
            $table->string('google_id')->nullable();
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
