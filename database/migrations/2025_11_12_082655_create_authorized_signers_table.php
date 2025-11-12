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
        Schema::create('authorized_signers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title')->nullable();
            $table->string('ssn')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('ownership_percentage', 5, 2)->nullable();
            $table->integer('years_with_company')->nullable();
            
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
        Schema::dropIfExists('authorized_signers');
    }
};
