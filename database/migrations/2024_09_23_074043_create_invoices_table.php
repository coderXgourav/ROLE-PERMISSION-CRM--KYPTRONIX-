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
       
            $table->integer('qty')->nullable();
            $table->integer('customer_package_main_id')->nullable();
           
            $table->string('invoice_unique_id')->nullable();
            $table->string('payment_status')->default(0);
            $table->timestamps();

             $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('package_id')->default(0);
            $table->string('role')->nullable();
            $table->integer('amount')->nullable();
            $table->text('description')->nullable();
                 $table->integer('price')->nullable();
            $table->string('title')->nullable();
            $table->string('date')->nullable();
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