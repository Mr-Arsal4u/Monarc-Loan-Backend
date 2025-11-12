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
        Schema::create('employment_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_borrower_id')->constrained()->onDelete('cascade')->index();
            $table->string('employment_status')->nullable();
            $table->string('employer_business_name')->nullable();
            $table->string('job_title')->nullable();
            $table->date('start_date')->nullable();
            $table->string('work_phone')->nullable();
            $table->integer('years_employed')->nullable();
            $table->integer('months_employed')->nullable();
            $table->integer('years_in_line_of_work')->nullable();
            $table->integer('months_in_line_of_work')->nullable();
            $table->boolean('is_business_owner')->default(false);
            $table->boolean('is_employed_by_family_member')->default(false);
            $table->string('ownership_share')->nullable();
            $table->string('industry')->nullable();
            
            // Monthly Income Breakdown
            $table->decimal('base_income', 12, 2)->default(0);
            $table->decimal('overtime_income', 12, 2)->default(0);
            $table->decimal('bonus_income', 12, 2)->default(0);
            $table->decimal('commission_income', 12, 2)->default(0);
            $table->decimal('military_entitlements', 12, 2)->default(0);
            $table->decimal('other_income', 12, 2)->default(0);
            $table->decimal('total_monthly_income', 12, 2)->default(0);
            
            $table->json('additional_data')->nullable();
            $table->timestamps();

            $table->index('loan_borrower_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_incomes');
    }
};
