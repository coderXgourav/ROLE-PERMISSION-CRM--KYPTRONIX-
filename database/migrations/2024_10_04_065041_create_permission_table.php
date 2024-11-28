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
        Schema::create('permission', function (Blueprint $table) {
            
            $table->id('permission_id');
            $table->string('user_id');
            
            // NEW 
            $table->string('user_type')->nullable();
            $table->string('service_add')->default(0)->nullable();
            $table->string('service_view')->default(0)->nullable();
            $table->string('service_edit')->default(0)->nullable();
            $table->string('service_details_view')->default(0)->nullable();
            $table->string('role_edit')->default(0)->nullable();
            $table->string('staff_registration')->default(0)->nullable();
            $table->string('staff_view')->default(0)->nullable();
            $table->string('staff_edit')->default(0)->nullable();
            $table->string('staff_details_view')->default(0)->nullable();
            $table->string('package_add')->default(0)->nullable();
            $table->string('package_view')->default(0)->nullable();
            $table->string('package_edit')->default(0)->nullable();
            $table->string('report_count')->default(0)->nullable();
            $table->string('report_staff')->default(0)->nullable();
            $table->string('report_individual')->default(0)->nullable();
            $table->string('report_business')->default(0)->nullable();
            $table->string('leads_add')->default(0)->nullable();
            $table->string('leads_view')->default(0)->nullable();
            $table->string('leads_import_individual')->default(0)->nullable();
            $table->string('leads_import_business')->default(0)->nullable();
            $table->string('clients_view')->default(0)->nullable();
            $table->string('assign_manage')->default(0)->nullable();
            $table->string('invoice_view')->default(0)->nullable();
            $table->string('email_view')->default(0)->nullable();
            $table->string('sms_view')->default(0)->nullable();
            $table->string('payments_successful')->default(0)->nullable();
            $table->string('payments_failed')->default(0)->nullable();
            $table->string('login_history_view')->default(0)->nullable();
            // NEW 

              // OLD 
            // $table->string('user_type')->nullable();
            // $table->string('service_permission')->default(0)->nullable();
            // $table->string('leads_permission')->default(0)->nullable();
            // $table->string('invoice_permission')->default(0)->nullable();
            // $table->string('payment_permission')->default(0)->nullable();
            // $table->string('customer_permission')->default(0)->nullable();
            // $table->string('email_sms_permission')->default(0)->nullable();;
            // $table->string('communication_permission')->default(0)->nullable();
            // $table->string('report_permission')->default(0)->nullable();
            // $table->string('document_view_permission')->default(0)->nullable();
            // $table->string('document_download_permission')->default(0)->nullable();
            // $table->string('lead_assign_permission')->default(0)->nullable();
            // $table->string('login_history_permission')->default(0)->nullable();
            // $table->string('service_manage_system')->default(0)->nullable();
            // $table->string('user_registration_permission')->default(0)->nullable();
            // $table->string('package_permission')->default(0)->nullable();
            // OLD 


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission');
    }
};