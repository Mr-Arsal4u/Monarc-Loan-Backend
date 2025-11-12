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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('loan_type')->index();
            // Commercial loan purpose fields
            $table->string('loan_purpose')->nullable()->after('loan_type');
            $table->decimal('loan_amount', 15, 2)->nullable()->after('loan_purpose');
            $table->text('certificate_of_business_purpose')->nullable()->after('loan_amount');
            $table->string('status')->default('draft')->index();
            $table->string('progress_step')->nullable()->index();
            $table->json('completed_steps')->nullable();
            $table->string('last_filled_step')->nullable();
            $table->timestamp('last_filled_at')->nullable();
            $table->decimal('percent_complete', 5, 2)->default(0)->index();
            $table->json('metadata')->nullable(); // For flexible additional data
            $table->softDeletes();
            $table->timestamps();

            $table->index(['loan_type', 'status']);
            $table->index(['user_id', 'loan_type']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
