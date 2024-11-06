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
        Schema::create('customer', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('customer_service_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_number')->nullable();

            $table->string('customer_email')->nullable();
            $table->string('task')->default(0);
            $table->string('team_member')->nullable(); 
            // $table->string('customer_service')->nullable();
            $table->string('status')->default(1);

            $table->string('type')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            $table->string('ssn')->nullable();

            $table->string('business_name')->nullable();
            $table->string('industry')->nullable();

            $table->string('fax')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();

            $table->string('ein')->nullable();
            $table->string('business_title')->nullable();
            $table->string('point_of_contact')->nullable();
            $table->text('msg')->nullable();
            $table->integer('paid_customer')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        Schema::dropIfExists('customer');
    }
};