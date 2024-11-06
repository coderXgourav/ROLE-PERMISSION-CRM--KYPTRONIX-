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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invoice_id');
            $table->integer('price')->nullable();
            $table->string('date')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->string('role')->nullable();
            $table->integer('amount')->nullable();
            $table->text('description')->nullable();
            $table->string('invoice_unique_id')->nullable();
            $table->string('payment_status')->default(0);
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};