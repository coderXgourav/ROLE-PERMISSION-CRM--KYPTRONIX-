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
            $table->enum('user_type',['customer_success_manager','team_manager','operation_manager','admin',"bookkeeper"]);
            $table->string('service_permission')->default(0);
            $table->string('leads_permission')->default(0);
            $table->string('invoice_permission')->default(0);
            $table->string('payment_permission')->default(0);
            $table->string('customer_permission')->default(0);
            $table->string('email_sms_permission')->default(0);
            $table->string('communication_permission')->default(0);
            $table->string('report_permission')->default(0);
            $table->string('document_view_permission')->default(0);
            $table->string('client_financial_data_permission')->default(0);
            $table->string('client_contact_permission')->default(0);
            $table->string('delete_client_record_permission')->default(0);
            $table->string('delete_all_record_permission')->default(0);
            $table->string('document_download_permission')->default(0);
            $table->string('lead_assign_permission')->default(0);
            $table->string('email_template_permission')->default(0);
            $table->string('login_history_permission')->default(0);
            $table->string('team_manager_permission')->default(0);
            $table->string('customer_success_manager_permission')->default(0);
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