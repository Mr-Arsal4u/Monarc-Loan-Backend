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
        Schema::create('loan_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade')->index();
            $table->foreignId('uploader_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('type')->index(); // e.g., 'w2', 'tax_return', 'bank_statement', 'certificate_of_business_purpose'
            $table->string('filename');
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable(); // in bytes
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['loan_application_id', 'type']);
            $table->index('uploader_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_documents');
    }
};
