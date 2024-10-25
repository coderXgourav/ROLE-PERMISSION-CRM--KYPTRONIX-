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
        Schema::create('remark', function (Blueprint $table) {
            $table->id('remark_id');
            $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('role')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remark');
    }
};