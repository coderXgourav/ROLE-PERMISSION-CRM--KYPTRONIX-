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
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id'); 
            $table->string('name');
            $table->string('service_id');
            $table->string('country_code')->nullable();;
            $table->string('phone_number');
            $table->string('email');
            $table->string('password');
            $table->string('status')->default(1);
            $table->string('otp')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};