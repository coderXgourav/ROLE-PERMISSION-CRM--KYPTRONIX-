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
        Schema::create('sub_subservice', function (Blueprint $table) {
            $table->id('sub_subservice_id');
            $table->string('main_service_id')->nullable();
            $table->string('sub_service_main_id')->nullable();
            $table->string('sub_subservice_name')->nullable();
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