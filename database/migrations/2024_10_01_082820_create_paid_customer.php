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
        Schema::create('paid_customer', function (Blueprint $table) {
            $table->id('paid_customer_id');
            $table->integer('customer_id')->nullable();
            $table->integer('team_member_id')->nullable();
            $table->integer('team_manager_id')->nullable();            
            $table->string('role')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paid_customer');
    }
};
