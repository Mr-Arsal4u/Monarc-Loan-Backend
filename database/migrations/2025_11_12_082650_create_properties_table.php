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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade')->index();
            
            // Property Address (can also use addresses table via polymorphic)
            $table->string('property_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 10)->nullable();
            
            // Residential Property Details
            $table->string('property_type')->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->decimal('down_payment', 15, 2)->nullable();
            $table->decimal('desired_loan_amount', 15, 2)->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->integer('loan_term')->nullable(); // in years
            
            // Commercial Collateral Details (when used as collateral)
            $table->string('collateral_type')->nullable();
            $table->decimal('estimated_collateral_value', 15, 2)->nullable();
            $table->text('collateral_description')->nullable();
            $table->decimal('existing_liens', 15, 2)->nullable();
            $table->decimal('estimated_market_value', 15, 2)->nullable();
            
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
        Schema::dropIfExists('properties');
    }
};
