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
        Schema::create('packages', function (Blueprint $table) {
            $table->id('package_id');
            $table->string('type')->nullable();
             $table->string('service_id')->nullable();
            $table->string('subservice_id')->nullable();
            $table->string('sub_subservice_id')->nullable();
            $table->string('title')->nullable();
            $table->string('price')->nullable();
            $table->string('desc')->nullable();
            $table->string('duration')->nullable();
            $table->string('free_trial')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Adds the 'deleted_at' column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};