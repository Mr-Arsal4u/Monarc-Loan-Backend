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
        Schema::create('financial_statements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade');
            
            // Business Financial Information (last 12 months)
            $table->decimal('annual_revenue', 15, 2)->nullable();
            $table->decimal('net_income', 15, 2)->nullable();
            $table->decimal('total_business_assets', 15, 2)->nullable();
            $table->decimal('total_business_liabilities', 15, 2)->nullable();
            $table->decimal('working_capital', 15, 2)->nullable();
            $table->decimal('accounts_receivable', 15, 2)->nullable();
            $table->decimal('accounts_payable', 15, 2)->nullable();
            $table->decimal('existing_debt_outstanding', 15, 2)->nullable();
            
            $table->json('additional_data')->nullable();
            $table->timestamps();

            $table->index('loan_application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_statements');
    }
};
