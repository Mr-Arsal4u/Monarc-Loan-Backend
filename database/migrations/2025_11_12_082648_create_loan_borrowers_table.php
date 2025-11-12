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
        Schema::create('loan_borrowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade')->index();
            $table->string('borrower_type')->default('primary')->index();
            
            // Personal Information (Residential)
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('ssn')->nullable()->index();
            $table->string('itin')->nullable();
            $table->text('alternate_names')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('credit_type')->nullable();
            $table->integer('total_borrowers')->nullable();
            $table->text('other_borrower_names')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('dependents_number')->nullable();
            $table->string('dependents_ages')->nullable();
            $table->string('citizenship')->nullable();
            
            // Business/Entity Information (Commercial)
            $table->string('borrower_legal_name')->nullable();
            $table->string('borrower_first_name')->nullable(); // For individual commercial borrowers
            $table->string('borrower_dba_name')->nullable();
            $table->string('entity_type')->nullable();
            $table->string('state_of_organization')->nullable();
            $table->date('date_of_filing')->nullable();
            $table->string('filing_locations')->nullable();
            
            // Contact Information
            $table->string('home_phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('work_phone_ext')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('main_contact_phone')->nullable();
            $table->string('secondary_contact_phone')->nullable();
            $table->string('fax')->nullable();
            
            // Experience (Commercial)
            $table->integer('years_experience_real_estate')->nullable();
            
            // Additional flexible data
            $table->json('additional_data')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->index(['loan_application_id', 'borrower_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_borrowers');
    }
};
