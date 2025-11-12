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
        Schema::create('asset_liabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade')->index();
            
            // Assets
            $table->decimal('checking_account_balance', 15, 2)->default(0);
            $table->decimal('savings_account_balance', 15, 2)->default(0);
            $table->decimal('retirement_account', 15, 2)->default(0); // 401k, IRA
            $table->decimal('stocks_investments', 15, 2)->default(0);
            $table->decimal('other_assets', 15, 2)->default(0);
            
            // Liabilities
            $table->decimal('existing_mortgage_debt', 15, 2)->default(0);
            $table->decimal('car_loans', 15, 2)->default(0);
            $table->decimal('credit_card_debt', 15, 2)->default(0);
            $table->decimal('other_debts', 15, 2)->default(0);
            
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
        Schema::dropIfExists('asset_liabilities');
    }
};
