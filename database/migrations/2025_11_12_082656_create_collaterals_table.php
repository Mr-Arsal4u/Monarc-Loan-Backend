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
        Schema::create('collaterals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade');
            $table->string('collateral_type');
            $table->text('collateral_description')->nullable();
            $table->decimal('estimated_collateral_value', 15, 2)->nullable();
            $table->decimal('existing_liens', 15, 2)->default(0);
            $table->decimal('estimated_market_value', 15, 2)->nullable();
            $table->string('property_address')->nullable(); // If applicable
            
            $table->json('additional_data')->nullable();
            $table->timestamps();

            $table->index(['loan_application_id', 'collateral_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaterals');
    }
};
