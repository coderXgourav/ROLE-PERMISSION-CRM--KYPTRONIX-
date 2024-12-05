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
        Schema::create('main_user', function (Blueprint $table) {
            $table->id();
            $table->string('account_name')->nullable();
            $table->string('password')->nullable();
            $table->string('password_hint')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
           //$table->enum('user_type',['customer_success_manager','team_manager','operation_manager','admin',"book_keeper"]);
            $table->string('user_type')->nullable();
            $table->integer('change_password_upon_login')->default(0);
            $table->integer('disable_account')->default(0);
            // $table->integer('delete_account')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_user');
    }
};