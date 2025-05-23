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
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('name')->nullable();
            $table->enum('user_type',['customer_success_manager','team_manager','operation_manager','admin',"bookkeeper"]);
            $table->timestamps();
            $table->softDeletes(); // Adds the 'deleted_at' column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');

    }
};